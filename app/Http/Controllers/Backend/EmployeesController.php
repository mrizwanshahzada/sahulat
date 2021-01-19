<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterEmployeeRequest;
use App\Models\Employee;

class EmployeesController extends Controller
{
    private $_employee;

    /**
     * EmployeesController constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee){
        $this->_employee = $employee;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewEmployee(){
        return view('backend.employee.add-new-employee');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trackEmployees(){
        return view('backend.employee.track-employees');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trackEmployeeLocation(){
        return view('backend.employee.track-employee-location');
    }

    /**
     * @param RegisterEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerNewEmployee(RegisterEmployeeRequest $request){
        $this->_employee->registerNewEmployee($request);
        return redirect()->route('adminDashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewEmployees(){
        $employees = $this->_employee->getEmployees()->reverse()->values();
        return view('backend.employee.view-employees')->with('employees', $employees);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEmployee($id){
        $employee = $this->_employee->getEmployee($id);
        return view('backend.employee.edit-employee')->with('employee', $employee);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmployeeSalary(Request $request){
        $this->_employee->updateEmployeeSalary($request);
        return redirect()->route('viewEmployees');
    }

}
