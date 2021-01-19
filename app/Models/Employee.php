<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmployeeRegisteration;
use App\Http\Requests\RegisterEmployeeRequest;
use Illuminate\Support\Str;

class Employee extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'phone','salary','rating', 'address', 'gender', 'email', 'status', 'password', 'profile_photo', 'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function vendorVerificationTasks()
    {
        return $this->hasMany(VendorVerificationTask::class);
    }

    /**
     * @param RegisterEmployeeRequest $request
     * @return mixed
     */
    public function registerNewEmployee(RegisterEmployeeRequest $request){

        $password = Str::random(8);

        $user = User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'email' => $request['email'],
            'role' => 'Employee',
            'profile_photo' => 'no-photo.jpg',
            'password' => Hash::make($password),
        ]);

        $this->create([
            'user_id' => $user->id,
            'salary' => $request['salary'],
            'rating' => 5,
            'status' => 'Active',
        ]);

        $user->notify(new EmployeeRegisteration($user->name, $password));
        return $user;
    }

    /**
     * @return Employee[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getEmployees(){
        $employees = Employee::all();
        return $employees;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployee($id){
        $employee = $this->find($id);
        return $employee;
    }

    /**
     * @param Request $request
     */
    public function updateEmployeeSalary(Request $request){
        $employee = $this->find($request->employee_id);
        $employee->update($request->all());
    }

    /**
     * @return int
     */
    public function countActive(){
        $active=Employee::all()->where('status','Active')->count();
        return $active;
    }

    /**
     * @return Employee[]|\Illuminate\Database\Eloquent\Collection|mixed|null
     */
    public function getAvailableEmployee(){
        if ($this->all()->where('status','Active')->count() > 0) {
            return $this->all()->where('status','Active')->random();
        }else{
            return Null;
        }
    }
}
