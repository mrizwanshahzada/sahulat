<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Notifications\RenewSubscription;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address', 'gender', 'email', 'password', 'profile_photo','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function getUser()
    {
        return Auth::user();
    }

    /**
     * @param Request $request
     */
    public function userUpdateProfile(Request $request){
        $user=Auth::user();
        $user->update($request->all());
        if($request->hasFile('profile_photo')){
            Storage::delete('images/user-profile-images/'.$user->profile_photo);
            $fileName = $user->id.$request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('images/user-profile-images',$fileName);
            $user->profile_photo=$fileName;
        }
        $user->update();
    }

    /**
     * @param $id
     * @return bool
     */
    public function userReadNotification($id){
        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if ($notification){
            $notification->delete();
            return true;
        }
        else{
            return false;
        }
    }

    public function notifyForSubscriptionRenew(){
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription){
//            dd(Carbon::parse($subscription->expiry)->toDateString());
            if (Carbon::parse($subscription->expiry)->toDateString() == Carbon::now()->addDays(5)->toDateString()){
                $img = $subscription->service->service_image;
                $msg = "Do you want to renew your subscription ?";
                $title = "Subscription";
                $subscription_id = $subscription->id;
                $subscription->user->notify(new RenewSubscription($img ,$msg, $title, $subscription_id));

            }
        };
    }


}
