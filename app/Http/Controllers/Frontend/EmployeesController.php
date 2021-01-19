<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Employee;
use App\Models\Vendor;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\DoneTask;
use App\Notifications\NewTask;
use App\Events\SendPosition;
use App\Utils\Globals\TaskStatus;
use App\Models\VendorVerificationTask;
use App\Notifications\StartTask;
use Carbon\Carbon;

class EmployeesController extends FrontendController
{
    private $_employee;
    private $_task;
    private $_vendorVerification;

    /**
     * EmployeesController constructor.
     * @param Employee $employee
     * @param Task $task
     * @param VendorVerificationTask $vendorVerification
     */
    function __construct(Employee $employee , Task $task , VendorVerificationTask $vendorVerification)
    {
        $this->_employee = $employee;
        $this->_task = $task;
        $this->_vendorVerification = $vendorVerification;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeDashboard(){
        $id = Auth::user()->employee->id;
        $tasks = $this->_task->employeeTask($id,'In Progress');
        return view('frontend.employee.dashboard.dashboard',['tasks' => $tasks]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeProfile(){
        $employee = Auth::user();
        return view('frontend.employee.employee-profile',compact('employee'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateProfile(){
        $user = Auth::user();
        return view('frontend.employee.employee-update-profile',compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateEmployee(Request $request){
        $this->validate($request ,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = Auth::user();
        $user->update($request->all());
        return redirect()->route('employeeProfile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeCompletedTasks(){
        $id = Auth::user()->employee->id;
        $tasks = $this->_task->employeeTask($id,'Completed');
        return view('frontend.employee.dashboard.completed-tasks',['tasks' => $tasks]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeCancelledTasks(){
        $id = Auth::user()->employee->id;
        $tasks = $this->_task->employeeTask($id,'Cancelled');
        return view('frontend.employee.dashboard.cancelled-tasks',['tasks' => $tasks]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorVerificatoinTasks(){
        $id = Auth::user()->employee->id;
        $tasks = $this->_vendorVerification->vendorVerificationTask($id);
        return view('frontend.employee.dashboard.vendor-verification-tasks')->with('tasks',$tasks);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trackVendorLocation($id)
    {
        $verify = $this->_vendorVerification->getTask($id);
        $lat = $verify->vendor->user->latitude;
        $long = $verify->vendor->user->longitude;
        return view('frontend.employee.dashboard.track-vendor-location',compact('lat','long'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeePendingTasks(){
        $id = Auth::user()->employee->id;
        $tasks = $this->_task->employeeTask($id,'Pending');
        return view('frontend.employee.dashboard.employee-pending-tasks')->with('tasks',$tasks);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeAssignedTasks(){
        $tasks=Auth::user()->employee->tasks->where('status','Assigned');
        return view('frontend.employee.dashboard.employee-assigned-tasks')->with('tasks',$tasks);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function employeeStartTask(Task $task){
        $task->status="In Progress";
        $task->start_date=Carbon::now()->toDateTimeString();
        $task->employee->status="Busy";
        $task->employee->save();
        $task->save();
        return redirect(route('employeeDashboard'));
    }

    /**
     * @param Request $request
     */
    public function employeeUpdateLocation(Request $request){
        $newCounter=$request->get('newCounter');
        if($newCounter==0){
        Auth::user()->latitude=$request->get('latitude');
        Auth::user()->longitude=$request->get('longitude');
        Auth::user()->save();        
        }
        $id=$request->get('taskId');
        $latitude=$request->get('latitude');
        $longitude=$request->get('longitude');
        broadcast(new SendPosition($latitude, $longitude,$id));
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function acceptUserRequest(Task $task){
        $img = $task->employee->user->profile_photo;
        $message = $task->employee->user->name." started your task ".$task->service->title;
        $user = $task->user;
        $user->notify(new StartTask($img ,$message, TaskStatus::ASSIGNED ));
        $task->status=TaskStatus::ASSIGNED;
        $task->save();
        return redirect(route('employeeAssignedTasks'));
    }

    /**
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function employeeRejectTask(Task $task){

        $employee=Auth::user()->employee;
        $employee->save();
        $isActive=Employee::all()->where('status','Active')->count();
        if($isActive==1)
        {
            $employee=Auth::user()->employee;
            $employee->save();
            return view('frontend.employee.dashboard.employee-reject-task');
        }
        else
        {
            $task->employee_id=Employee::all()->where('status','Active')->random()->id;
            $task->save();
            $msg="New Task from ".$task->user->name;
            $img =  $task->user->profile_photo;
            $title = TaskStatus::PENDING;
            Employee::where('id',$task->employee_id)->first()->notify(new NewTask($img,$msg,$title));
            return redirect(route('employeePendingTasks'));
        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutEmployee(){
        Auth::logout();
        return redirect('/');
    }

    /**
     * @param Request $request
     */
    public function map(Request $request){
        $lat=$request->input('lat');
        $long=$request->input('long');
        dd($lat);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function employeeDoneTask(Task $task)
    {
        $task->status="Verifying";
        $task->save();
        $task->employee->status="Active";
        $task->push();

        $msg=" Task ".$task->service->title." done by ".$task->employee->user->name."Please check in Verifying Task";
        User::where('id',$task->user_id)->first()->notify(new DoneTask( $task->employee->user->profile_photo,$msg,TaskStatus::VERIFYING));
        return redirect(route('employeeDashboard'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeVerifyingTasks()
    {
        $tasks=Auth::user()->employee->tasks->where('status','Verifying');
        return view('frontend.employee.dashboard.employee-verifying-tasks')->with('tasks',$tasks);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employeeReadNotification($id)
    {
        $employee = \Auth::user()->employee;
        $notification = $employee->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->delete();
            return back();
        }else{
            return back()->withErrors('we could not found the specified notification');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function employeeVerifyVendor(Request $request)
    {
        if($request->ajax()){
            $task_id = $request->id;
            $status = $request->status;
            $task = VendorVerificationTask::find($task_id);
            $vendor = Vendor::find($task->vendor_id);
            $task->status = $status;
            $vendor->status = $status;
            $task->save();
            $vendor->save();
            return $status;
        }
    }

}
