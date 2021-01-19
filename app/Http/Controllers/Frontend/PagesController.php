<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Task;
use DB;
use Illuminate\Http\Request;
use App\Utils\Globals\ServiceStatus;
use Illuminate\Support\Facades\Auth;

class PagesController extends FrontendController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $services=DB::table('services')->where('vendor_id', '!=', NULL)->where('status',ServiceStatus::ACTIVE)->simplePaginate(8);
        $ourServices=DB::table('services')->where('vendor_id', '=', NULL)->where('status',ServiceStatus::ACTIVE)->simplePaginate(8);
        $tasks=DB::table('tasks')->where('status','Complete')->get();
        $users=DB::table('users')->where('role','Customer')->get();
        $vendors=DB::table('users')->where('role','Vendor')->get();
        $vendorsCompanies=DB::table('vendors')->where('company_name','!=',NULL )->get();
        $topVendors=Vendor::inRandomOrder()->whereBetween('rating', [4, 5])->limit(5)->get();
        $ourTopServices=Task::inRandomOrder()->where('employee_id','!=',NULL)->where('status','Completed')->whereBetween('rating',[4, 5])->limit(6)->get();
        return view('frontend.pages.index')->with(compact('services','tasks','users','vendors','vendorsCompanies','topVendors','ourTopServices','ourServices'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function suggestSearch(Request $request){
        $term = $request->term;
        $services = Service::where('title', 'like', '%'.$term.'%')->take(8)->get();
        $suggestions = array();
        foreach ($services as $service) {
            $suggestions[] = $service->title;
        }
        return $suggestions;
    }

    public function fetchNearbyVendors(Request $request){

        $nearbyUsers = User::all()->where('role', 'Vendor');
        $vendorServices = array();
        $keywords = $request->keywords;
        $latFrom = $request->latitude;
        $lonFrom = $request->longitude;

        foreach ($nearbyUsers as $user){
            $latTo = $user->latitude;
            $lonTo = $user->longitude;
            if (intval(distance($latFrom, $lonFrom, $latTo, $lonTo)) <= intval($request->distance)){
                $service = Service::where('vendor_id', $user->vendor->id)->where('status', 'Active')->where('title', 'like', '%'.$keywords.'%')->first();
                if ($service != NULL){
                    $vendorServices[] = $service;
                }
            }
        }
        return view('frontend.pages.search-content')->with('data', ['vendorsServices'=>$vendorServices]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request){
        $vendorsServices = Service::whereNotNull('vendor_id')->where('status', 'Active')->where('title', 'like', '%'.$request->get('keywords').'%')->get();
        $sahulatServices = Service::where('vendor_id', '=', NULL)->where('title', 'like', '%'.$request->get('keywords').'%')->get();
        return view('frontend.pages.search-result')->with('data', ['vendorsServices'=>$vendorsServices, 'sahulatServices'=>$sahulatServices, 'keywords'=>$request->get('keywords')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){
        return view('frontend.pages.about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(){
        return view('frontend.pages.contact');
    }

}

function distance($lat1, $lon1, $lat2, $lon2) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    }
    else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles * 1.609344);
    }
}
