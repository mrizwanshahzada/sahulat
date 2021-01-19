<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Payment extends Model
{

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @param $task_id
     * @param $ammount
     * @param $status
     */
    public function taskPayment($task_id,$ammount,$status)
    {
    	$payment = new Payment;
    	$payment->task_id = $task_id;
    	$payment->amount = $ammount;
    	$payment->status = $status;
    	$payment->save();
    }

    public function getPaymentsHistory(){
        return $this->all();
    }

}
