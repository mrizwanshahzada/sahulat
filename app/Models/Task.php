<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Notifications\userRejectTask;
use App\Models\Employee;
use App\Models\Subscription;
use App\Utils\Globals\TaskStatus;
use Auth;
use Illuminate\Support\Carbon;


class Task extends Model
{


    protected $fillable = ['budget' , 'status' , 'deadline'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @param $type
     * @return Task[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTasks($type){
        switch ($type) {
            case 'Vendor':
                $tasks = $this->all()->whereNotNull('vendor_id');
                break;
            case 'Employee':
                $tasks = $this->all()->whereNotNull('employee_id');
                break;
            default:
                $tasks = $this->all();
                break;
        }
        return $tasks;
    }

    public function createNewEmployeeTask(Request $request,Service $service,$employee_id){
          $task=new Task;
          $task->user_id=Auth::user()->id;
          $task->service_id=$service->id;
          $task->budget=$service->charges;
          $task->status="Pending";
          $task->deadline=$request->date;
          $task->employee_id=$employee_id;
          $task->save();
          return $task;

    }

    /**
     * @param Task $task
     * @param $status
     * @return bool
     */
    public function userDeleteTask(Task $task,$status){
        if($task->user_id == Auth::user()->id){
            $task->update(['status' => $status]);
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function userRatingTask(Task $task){
        if(Auth::user()->id==$task->user_id){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param Task $task
     * @param Request $request
     * @return bool
     */
    public function userSubmitRatingTask(Task $task,Request $request){
        if(Auth::user()->id==$task->user_id){
            if($task->rating==Null){
                $task->status=TaskStatus::COMPLETED;
                $task->rating=$request->rating;
                if($task->employee_id!=Null){
                    $task->employee->status="Active";
                    $task->employee->save();
                }
                $task->finish_date=Carbon::now()->toDateTimeString();
                $task->save();
                // for rating avg
                if($task->vendor_id!=Null)
                {
                    $vendor=Vendor::find($task->vendor_id);
                    $tasksCount=$vendor->tasks->count();
                    $vendorTasks=$vendor->tasks;
                    $rating=0.0;
                    foreach ($vendorTasks as $task) {
                        $rating=$rating+$task->rating;
                    }
                    $avg=$rating/$tasksCount;
                    $task->vendor->rating=$avg;
                    $task->vendor->save();
                }
                else{
                    $employee=Employee::find($task->employee_id);
                    $tasksCount=$employee->tasks->count();
                    $employeeTasks=$employee->tasks;
                    $rating=0.0;
                    foreach ($employeeTasks as $task) {
                        $rating=$rating+$task->rating;
                    }
                    $avg=$rating/$tasksCount;
                    $task->employee->rating=$avg;
                    $task->employee->save();
                }
                // end rating avg
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    /**
     * @param Task $task
     * @param $status
     * @return bool
     */
    public function userRejectTask(Task $task ,$status){
        if(Auth::user()->id==$task->user_id){
            $task->update(['status' => $status]);
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function vendorsTask($id,$status)
    {
        # code...
        $tasks = $this->where('vendor_id',$id)->where('status',$status)->get();
        return $tasks;
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function employeeTask($id,$status)
    {
        $tasks = $this->where('status',$status)->where('employee_id', $id)->get();
        return $tasks;
    }

    /**
     * @param Request $request
     * @param $service
     * @return Task
     */
    public function createNewVendorTask(Request $request ,$service)
    {
        $task = $this;
        $task->user_id = Auth::user()->id;
        $task->service_id = $service->id;
        $task->vendor_id = $service->vendor_id;
        $task->budget = $service->charges;
        $task->status = "Pending";
        $task->deadline =$request->deadline;
        $task->save();
        return $task;
    }

    /**
     * @param $id
     * @param $status
     */
    public function updateVendorTask($id , $status)
    {
        # code...
        $task = $this->find($id);
        $task->update(['status' => $status]);
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function getVendorTask($id,$status)
    {
        # code...
        $tasks = $this->where('vendor_id',$id)->where('status',$status)->get();
        return $tasks;

    }

    /**
     * @param $id
     */
    public function deleteTask($id)
    {
        $task = $this->find($id);
        $task->status = 'Rejected';
        $task->update();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTask($id)
    {
        return $this->find($id);
    }

    /**
     * @param $id
     * @param $budget
     */
    public function updateBudget($id, $budget)
    {
        $task = $this->find($id);
        $task->budget = $budget;
        $task->save();
    }

    /**
     * @param $vendorId
     * @param $serviceId
     * @param $userId
     * @param $budget
     * @param $status
     * @return Task
     */
    public function initializeTask($vendorId , $serviceId , $userId , $budget , $status)
    {
        $task = $this;
        $task->vendor_id = $vendorId;
        $task->service_id = $serviceId;
        $task->user_id = $userId;
        $task->budget = $budget;
        $task->status =$status;
        $this->save();
        return $task;
    }

    /**
     * @return bool
     */
    public function createSubscriptionTasks(){
        $subscriptions = Subscription::where('status', 'Active')->where('task_date', Carbon::now()->toDateString())->get();


        if (count($subscriptions) > 0) {
            foreach ($subscriptions as $subscription) {
                $task = new Task();
                $task->user_id = $subscription->user_id;
                $task->employee_id = Employee::all()->where('status','Active')->random()->id;
                $task->service_id = $subscription->service_id;
                $task->budget = ($subscription->charges)/($subscription->duration / $subscription->frequency);
                $task->status = TaskStatus::PENDING;
                $task->deadline = Carbon::now()->addDays(1);
                $task->save();

                $subscription->task_date = Carbon::now()->addDays($subscription->frequency);
                $subscription->update();
            }
        }
        return true;

    }

    public function assignTasks(){
        $tasks = $this->all()->where('vendor_id', null)->where('status', TaskStatus::PENDING);
        foreach ($tasks as $task){
            $task->employee_id = Employee::all()->where('status','Active')->random()->id;
            $task->update();
        }
    }

}
