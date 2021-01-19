<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Task;
use App\Models\Subscription;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewTask;
use App\Notifications\CancelTaskVendor;
use App\Notifications\userRejectTask;
use DB;
use App\Utils\Globals\TaskStatus;

class UsersController extends FrontendController
{

    private $_user;
    private $_employee;
    private $_task;

    /**
     * UsersController constructor.
     * @param User $user
     * @param Employee $employee
     * @param Task $task
     */
    public function __construct(User $user,Employee $employee,Task $task){
        $this->_user = $user;
        $this->_employee = $employee;
        $this->_task = $task;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerProfile(){
        $user=$this->_user->getUser();
        return view('frontend.user.customer-profile')->with('user',$user);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerEditProfile(){
        $user=$this->_user->getUser();
        return view('frontend.user.customer-edit-profile')->with('user' ,$user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customerUpdateProfile(Request $request){
        $this->_user->userUpdateProfile($request);
        return redirect()->route('customerProfile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mySubscription(){
        $subscriptions = Subscription::all()->where('user_id', Auth::user()->id);
        return view('frontend.user.dashboard.my-subscription',
            compact('subscriptions'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSubs($id){
        $subscription = Subscription::find($id);
        $subscription->status = 'Canceled';
        $subscription->save();

        $id = Auth::user()->id;
        return redirect()->route('mySubscription');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerDashboard(){
        $tasks =Task::where('user_id',  Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'In Progress');
            })
            ->get();
        $tasksAssigned =Task::where('user_id',  Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'Assigned');
            })
            ->get();
        return view('frontend.user.dashboard.dashboard',
            compact('tasks'),compact('tasksAssigned'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function completedTasks(){
        $tasks =Task::where('user_id',  Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'Completed');
            })
            ->get();
        return view('frontend.user.dashboard.completed-tasks',
            compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cancelledTasks(){
        $tasks =Task::where('user_id',  Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'Cancelled');
            })
            ->get();
        return view('frontend.user.dashboard.cancelled-tasks',
            compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerPendingTasks(){
        $tasks =Task::where('user_id',  Auth::user()->id)->where(function ($query) {
            $query->where('status', 'Pending');
        })->get();
        return view('frontend.user.dashboard.customer-pending-tasks',
            compact('tasks'));
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function userBuyServiceForm(Request $request,Service $service){
        $isActive=$this->_employee->countActive();
        if($isActive < 1){
            return "<h1 align='center'> We're sorry! No employee is available at the moment. Please try later.</h1>";
        }
        else {
            \Stripe\Stripe::setApiKey(config('app.stripe_key'));
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $service->charges,
                'currency' => 'usd',
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
            $client_secret = $intent->client_secret;
            return view('frontend.service.user-buy-service-form', compact('client_secret', 'service'));
        }
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function userBuyService(Request $request ,Service $service){

        $this->validate($request ,[
            'date'=>'required|date',
        ]);

        $isActive=$this->_employee->countActive();
        if($isActive < 1){
            return "no employee available please try later";
        }
        else{
          //dev rizwan


          $all_employee = Employee::where('status','Active')->get();

          $closest =0;
          $emp = null;
          $earthRadius = 6371000;
          foreach ($all_employee as $employee) {

          $latFrom = deg2rad($request->lat);
          $lonFrom = deg2rad($request->long);
          $latTo = deg2rad($employee->user->latitude);
          $lonTo = deg2rad($employee->user->longitude);

          $latDelta = $latTo - $latFrom;
          $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            $distance = $angle * $earthRadius;

            if($distance <= $closest  || $closest==0){
              $closest = $distance;
              $emp = $employee;
            }
          }


          $task=$this->_task->createNewEmployeeTask($request,$service,$emp->id);
          $msg="New Task from ".$task->user->name;
          $img =  $task->user->profile_photo;

          $title = TaskStatus::PENDING;
         $emp->notify(new NewTask($img,$msg,$title));


            $payment = new Payment();
            $payment->task_id = $task->id;
            $payment->amount = $task->budget;
            $payment->user_id = $task->user_id;
            $payment->status = 'Paid';
            $payment->save();

            return redirect(route('customerPendingTasks'));
        }


    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userDeletePendingTask(Task $task){
        $reciever=null;
        if($task->vendor != null){
            $reciever = $task->vendor;
        }else{
            $reciever = $task->employee;
        }
        if($this->_task->userDeleteTask($task,TaskStatus::CANCELED)){
            $msg = $task->user->name." cancel your task ".$task->service->title;
            $img = $task->user->profile_photo;
            $title = TaskStatus::CANCELED;
            $reciever->notify(new NewTask($img,$msg,$title));
            return redirect()->back();
        }
        else{
            dd("you are not auhorize");
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutCustomer(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function userRatingTask(Task $task){

        // dd($task->vendor);

        if($this->_task->userRatingTask($task)){
            // if ($task->vendor_id != null){
            //     \Stripe\Stripe::setApiKey(config('app.stripe_key'));
            //     $transfer = \Stripe\Transfer::create([
            //         "amount" => $task->budget,
            //         "currency" => "usd",
            //         "source_transaction" => $task->name,
            //         "destination" => $task->vendor->account_number,
            //     ]);
            // }

            return view('frontend.user.dashboard.user-rating-task')->with('task',$task);
        }
        else{
            return back();
        }
    }






    /**
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userSubmitRatingTask(Task $task, Request $request){
        if($this->_task->userSubmitRatingTask($task,$request))
        {
            return redirect()->route('customerDashboard');
        }
        else{
            dd("rating is already fill");
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerVerifyingTasks()
    {
        $tasks=Auth::user()->tasks->where('status','Verifying');
        return view('frontend.user.dashboard.customer-verifying-tasks')->with('tasks',$tasks);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userRejectTask(Task $task)
    {
        
        return view('frontend.user.dashboard.user-cancel-feedback')->with('task',$task);

    }

    public function cancelFeedback(Request $request , Task $task)
    {
        # code...

        // dd($request->all());

        $reciever=null;
        if($task->vendor != null){
            $reciever = $task->vendor;
        }else{
            $reciever = $task->employee;
        }
        if($this->_task->userRejectTask($task,TaskStatus::INPROGRESS)){
            $msg = $task->user->name." is no satisfied ".$task->service->title.".\n Customer reaction :".$request->comments;
            $img = $task->user->profile_photo;
            $title = TaskStatus::INPROGRESS;
            $reciever->notify(new userRejectTask($img,$msg,$title));
            return redirect(route('customerVerifyingTasks'));
        }
        else{
            return back();
        }




    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customerReadNotification($id){
        if($this->_user->userReadNotification($id)){
            return back();
        }
        else{
            return back()->withErrors('we could not found the specified notification');
        }
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerTrackEmployee(Task $task){
        return view('frontend.user.dashboard.customer-track-employee')->with('task',$task);
    }

    /**
     * @param Request $request
     */
    public function employeeSaveCoordinates(Request $request){
        $updatedData=$request->get('newData');
        Storage::disk('public')->put('saad.geojson',$updatedData);
    }

}
