<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Task;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewTask;
use App\Notifications\AssignTask;
use App\Notifications\CancelTaskVendor;
use App\Notifications\StartTask;
use App\Notifications\UpdateTask;
use App\Notifications\VendorRejectTask;
use App\Notifications\UserBuyVendorService;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use App\Utils\Globals\TaskStatus;
use App\Notifications\DoneTask;
use App\Notifications\RejectOffer;
use Carbon\Carbon;

class TasksController extends FrontendController
{

    private $_task;
    private $_payment;
    private $_vendor;
    private $_service;
    function __construct(Task $task , Payment $payment , Vendor $vendor , Service $service)
    {
        $this->_task = $task;
        $this->_payment = $payment;
        $this->_vendor = $vendor;
        $this->_service = $service;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerChat($id){
        return view('frontend.pages.chat');
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateTask(Task $task){
        return view('frontend.task.update-task',compact('task'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveChanges(Request $request , $id){
        $task =  Task::find($id);
        $task->update(['budget' => $request->budget,
            'status' => $request->status,
            'deadline' => $request->deadline]);

        return redirect()->route('vendorDashboard');
    }

    /**
     * @param Request $request
     */
    public function createTask(Request $request){
        $service = $this->_service->getService($request->service_id);
        $task = $this->_task->createNewVendorTask($request,$service);
        $this->_payment->taskPayment($task->id,$task->budget,'Paid');
        $vendor= $this->_vendor->getVendorById($task->vendor_id);
        $msg = $task->user->name.' want to buy your service '.$task->service->title;
        $img =  $task->user->profile_photo;
        $vendor->notify(new NewTask($img,$msg,TaskStatus::PENDING));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function requestVendor($id,$notificationId){
        $task = $this->_task->getTask($id);
        $task->user->userReadNotification($notificationId);
        $service = $task->service;
        $task_id = $task->id;
        \Stripe\Stripe::setApiKey(config('app.stripe_key'));

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $service->charges,
            'currency' => 'usd',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        $client_secret = $intent->client_secret;
        return view('frontend.service.buy-service',compact('task','client_secret','task_id'));
    }

    /**
     * @param Task $task
     * @throws \Exception
     */
    public function deleteTask(Task $task){
        $task->delete();
        $user = Task::find($task->user_id);
        $user->notify(new CancelTaskVendor($task->vendor_id , $task->id));
    }

    /**
     * @param Request $request
     * @param Service $service
     */
    public function createNewEmployeeTask(Request $request,Service $service){
        $task=new Task;
        $task->user_id=Auth::user()->id;
        $task->service_id=$service->id;
        $task->budget=$service->charges;
        $task->status="Pending";
        $task->deadline=$request->date;
        $task->employee_id=Employee::all()->where('status','Active')->random()->id;
        $task->save();
    }

    /**
     * @param $task_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assigntTaskStatus($task_id )
    {
        $task = $this->_task->getTask($task_id);
        $this->_task->updateVendorTask($task_id , TaskStatus::ASSIGNED);
        $user = $task->user;
        $img = $task->vendor->user->profile_photo;
        $message = $task->vendor->user->name." accepted your task ".$task->service->title;
        $user->notify(new AssignTask($img ,$message, TaskStatus::ASSIGNED ));

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assignVendorTask()
    {
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->getVendorTask($id,TaskStatus::ASSIGNED);
        return view('frontend.vendor.dashboard.pages.assigned-task' , compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function progresstaskStatus($id)
    {
        $task = $this->_task->getTask($id);
        $img = $task->vendor->user->profile_photo;
        $message = $task->vendor->user->name." started your task ".$task->service->title;
        $user = $task->user;
        $task->start_date=Carbon::now()->toDateTimeString();
        $task->save();

        $user->notify(new StartTask($img ,$message, TaskStatus::INPROGRESS ));
        $this->_task->updateVendorTask($id , TaskStatus::INPROGRESS);
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorCurrentTask()
    {
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->getVendorTask($id,TaskStatus::INPROGRESS);
        return view('frontend.vendor.dashboard.pages.work-in-progress-task' , compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorVerifyingTask()
    {
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->getVendorTask($id,TaskStatus::VERIFYING);
        return view('frontend.vendor.dashboard.pages.vendor-verifying-task' , compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyTaskStatus($id)
    {
        $task = $this->_task->getTask($id);
        $msg=" Task ".$task->service->title." done by ".$task->vendor->user->name."Please check in Verifying Task";
        $user = $task->user;
        $user->notify(new DoneTask( $task->vendor->user->profile_photo,$msg,TaskStatus::VERIFYING));
        $this->_task->updateVendorTask($id , TaskStatus::VERIFYING);
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelTaskStatus($id)
    {
        $this->_task->updateVendorTask($id , TaskStatus::CANCELED);
        $task = $this->_task->getTask($id);
        $message = 'Cancel task from '.$task->vendor->user->name." against service ".$task->service->title;
        $user = $task->user;
        $user->first()->notify(new CancelTaskVendor($message,TaskStatus::CANCELED));

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorCanceledTask()
    {
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->getVendorTask($id,TaskStatus::CANCELED);
        return view('frontend.vendor.dashboard.pages.vendor-canceled-task' , compact('tasks'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectTask($id)
    {
        $this->_task->deleteTask($id);
        $task = $this->_task->getTask($id);
        $img = $task->vendor->user->profile_photo;
        $status = 'Rejected';
        $msg = $task->vendor->user->name." reject to do your task.";
        $task->user->notify(new UpdateTask($img,$msg,$status,$task->id));


        return redirect()->route('vendorDashboard');
    }

    /**
     * @param Request $request
     */
    public function updateBudget(Request $request)
    {
        $this->_task->updateBudget($request->task_id, $request->budget);
        $task = $this->_task->getTask($request->task_id);
        $img = $task->vendor->user->profile_photo;
        $status = TaskStatus::UPDATE;
        $msg = $task->vendor->user->name." offered the service in ".$task->budget." . Do you accept it? ";
        $task->user->notify(new UpdateTask($img,$msg,$status,$task->id));
    }

    /**
     * @param $id
     */
    public function updateTaskStatus($id)
    {
        $task = $this->_task->getTask($id);
        $payment = new Payment();
        $payment->task_id = $task->id;
        $payment->amount = $task->budget;
        $payment->user_id = Auth::user()->id;
        $payment->status = 'Paid';
        $payment->save();

         $img = $task->user->profile_photo;
        $status = TaskStatus::ASSIGNED;
        $msg = $task->user->name." paid Rs ".$task->budget ." for your service ".$task->service->title;
        $task->vendor->notify(new UserBuyVendorService($img,$msg,$status));


        return $this->_task->updateVendorTask($id,TaskStatus::ASSIGNED);
    }

    public function rejectOffer($id,$notificationId){
        $task = $this->_task->find($id);
        $task->vendor->notify(new RejectOffer($task->user->profile_photo, 'The customer'.$task->user->name.' rejected your offer for service '.$task->service->title, 'Rejected Offer', $id));
        $task->user->userReadNotification($notificationId);
        return redirect()->back();
    }

}

