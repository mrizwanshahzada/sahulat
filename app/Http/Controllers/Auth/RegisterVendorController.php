<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\VendorRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VendorRegisterRequest;
use App\Utils\Globals\VendorStatus;
use App\Utils\Globals\UserType;
use App\Utils\Globals\ServiceStatus;



class RegisterVendorController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        $user = new User;
        $service = new Service;
        $vendor = new Vendor;

        return view('frontend.pages.vendor-registration',compact('user','service','vendor'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_name' => ['string'],
            'business_location' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'charges' => ['required'],
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(VendorRegisterRequest $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
          $user->latitude=$data['lat'];
          $user->longitude=$data['long'];

        $user->role = UserType::VENDOR;

        if ($data->hasFile('profile_photo')){
            $path = $data->file('profile_photo')->storeAs('images/user-profile-images/', 'photo'.$user->id.'.jpg');
            $user->profile_photo = 'photo'.$user->id.'.jpg';
        }else{
            $user->profile_photo = 'no-photo.jpg';
        }

        $user->save();

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'company_name' => $data['company_name'],
            'business_location' => $data['business_location'],
            'status' => VendorStatus::PENDING,
            'account_number' => $data['account_number'],
        ]);

        $service = Service::create([
            'vendor_id' => $vendor->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'charges' => $data['charges'],
            'requirements' => $data['requirements'],
            'status' => ServiceStatus::INACTIVE,
        ]);

        if ($data->hasFile('service_image')){
            $path = $data->file('service_image')->storeAs('images/service-images/', 'image'.$service->id.'.jpg');
            $service->service_image = 'image'.$service->id.'.jpg';
        }else{
            $serviceFileName = 'no-image.jpg';
        }
        $service->save();

        User::where('role', UserType::ADMIN)->first()->notify(new VendorRequest($user->name, $user->profile_photo, $service->title));

        return redirect()->route('login');
    }

    public function checkEmailAvailability(Request $request){
        if (DB::table('users')->where('email', $request->get('email'))->count() > 0){
            return 'not available';
        }else{
            return 'available';
        }
    }

    public function checkPhoneAvailability(Request $request){
        if (DB::table('users')->where('phone', $request->get('phone'))->count() > 0){
            return 'not available';
        }else{
            return 'available';
        }
    }

}
