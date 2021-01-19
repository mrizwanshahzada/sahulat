<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VendorVerificationTask extends Model
{
    protected $fillable = ['vendor_id' , 'employee_id' , 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function vendorVerificationTask($id)
    {
        $tasks = $this->where('employee_id' , $id)->where('status' , 'Verifying')->get();
        return $tasks;
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
     * @return bool
     */
    public function createTask($id){
        $employee = new Employee();
        $randomEmployee = $employee->getAvailableEmployee();
        if ($randomEmployee != Null) {
            $this->create([
                'vendor_id' => $id,
                'employee_id' => $randomEmployee->id,
                'status' => 'Verifying'
            ]);
            return true;
        }else{
            return false;
        }
    }
}
