<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

	 public function user()
    {
    	return $this->belongsTo(User::class);
    }
     public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected $fillable = [
        // frequency yet to be set
        'user_id', 'service_id', 'frequency', 'charges', 'duration', 'expiry', 'status', 'task_date',
    ];

	 public function expireSubscription(){
	     $subscriptions = $this->all();
	     foreach ($subscriptions as $subscription){

	         if (Carbon::parse($subscription->expiry)->addDays(1)->toDateString() == Carbon::now()->toDateString()){
                $subscription->status = 'Expired';
                $subscription->save();
             }
         }
     }

}
