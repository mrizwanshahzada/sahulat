<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Vendor extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address', 'gender', 'email', 'password', 'profile_photo', 'user_id', 'status', 'company_name', 'business_location', 'title', 'description', 'image_service', 'charges', 'requirements', 'account_number',
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function vendorVerificationTasks()
    {
        return $this->hasOne(VendorVerificationTask::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function viewServices()
    {
        $services = $this->services();
        return $services;
    }

    /**
     * @return mixed
     */
    public function getPendingVendorsCount(){
        $vendor_requests = $this->where('status', 'Pending')->count();
        return $vendor_requests;
    }

    /**
     * @return Vendor[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPendingVendors(){
        $vendors = Vendor::all()->whereIn('status', ['Pending', 'Verifying', 'Verified', 'Denied'])->reverse()->values();
        return $vendors;
    }

    /**
     * @param $id
     */
    public function approveVendor($id){
        $vendor = $this->find($id);
        $vendor->status = 'Active';
        $vendor->update();
    }

    /**
     * @param $id
     */
    public function cancelVendorRequest($id){
        $vendor = $this->find($id);
        $vendor->status = 'Cancelled';
        $vendor->update();
    }

    /**
     * @param $id
     */
    public function verifyVendor($id){
        $vendor = $this->find($id);
        $vendor->status = 'Verifying';
        $vendor->update();
    }

    /**
     * @return mixed
     */
    public function getVendor(){
        return Auth::user()->vendor;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getVendorById($id)
    {
        return $this->find($id);
    }

    /**
     * @param Request $request
     */
    public function updateProfile(Request $request){

        $user = Auth::user();
        $user->update($request->all());
        $user->vendor->update(['company_name'=>$request->company_name, 'business_location'=>$request->business_location]);

        if($request->hasFile('profile_photo')){
            Storage::delete('images/user-profile-images/'.$user->profile_photo);
            $fileName = $user->id.$request->file('profile_photo')->getClientOriginalName();
            $path = $request->file('profile_photo')->storeAs('images/user-profile-images',$fileName);
            $user->profile_photo=$fileName;
            $user->update();
        }

    }

}
