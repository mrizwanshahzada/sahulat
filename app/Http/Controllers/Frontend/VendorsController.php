<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use App\Models\Service;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\VendorRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateVendorService;
use App\Utils\Globals\TaskStatus;
use App\Http\Requests\UpdateVendorProfileRequest;
use App\Notifications\PendingVendorTask;

class VendorsController extends FrontendController
{
    private $_vendor;
    private $_service;
    private $_task;

    /**
     * VendorsController constructor.
     * @param Vendor $vendor
     * @param Service $vendorServices
     * @param Task $task
     */
    public function __construct(Vendor $vendor, Service $vendorServices , Task $task){
        $this->_vendor = $vendor;
        $this->_service = $vendorServices;
        $this->_task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("frontend.vendor.vandor-account");
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('frontend.vendor.vendor-profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorProfile()
    {
        $vendor = $this->_vendor->getVendor();
        $services = $this->_service->getVendorServices($vendor->id);
        return view('frontend.vendor.vendor-profile')->with('data', ['vendor'=>$vendor, 'services'=>$services]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editVendorProfile(){
        $vendor = $this->_vendor->getVendor();
        return view('frontend.vendor.vendor-edit-profile')->with('vendor', $vendor);
    }

    /**
     * @param VendorRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVendorProfile(UpdateVendorProfileRequest $request)
    {
        $vendor = $this->_vendor->updateProfile($request);
        return redirect()->route('vendorProfile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorDashboard(){
        return view('frontend.vendor.dashboard.pages.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewServices(){
        $services = $this->_vendor->viewServices();
        dd($services);
        return view('frontend.vendor.dashboard.pages.view-services' , compact('services'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pandingTasks(){
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->vendorsTask($id,TaskStatus::PENDING);
        return view('frontend.vendor.dashboard.pages.pending-task',
            compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function completeTasks(){
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->vendorsTask($id,TaskStatus::COMPLETED);
        return view('frontend.vendor.dashboard.pages.vendors-task',
            compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cancelTasks(){
        $id = Auth::user()->vendor->id;
        $tasks = $this->_task->vendorsTask($id,TaskStatus::CANCELED);
        return view('frontend.vendor.dashboard.pages.vendors-task',
            compact('tasks'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewService(){
        $service = new Service;
        return view('frontend.vendor.dashboard.pages.add-new-service',compact('service'));
    }

    /**
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editVendorService(Service $service)
    {
        return view('frontend.vendor.dashboard.pages.edit-vendor-service')->with('service',$service);
    }

    /**
     * @param UpdateVendorProfileRequest $request
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateVendorService(UpdateVendorService $request ,Service $service)
    {
        if($service->vendor_id==Auth::user()->vendor->id){

            if($request->hasFile('service_image')){
                Storage::delete('public/images/service-images/'.'image'.$service->id.'.jpg');
                $path = $request->file('service_image')->storeAs('images/service-images', 'image'.$service->id.'.jpg');
                $service->service_image = 'image'.$service->id.'.jpg';
                $service->save();
            }
            $service->title=$request->title;
            $service->charges=$request->charges;
            $service->description=$request->description;
            $service->requirements=$request->requirements;
            $this->_service->updateVendorService($service);
            return redirect(route('showVendorServices'))->with('success','successfully update.');
        }else{
            return back();
        }

    }

    /**
     * @param Service $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function deleteVendorService(Service $service)
    {
        if($service->vendor_id==Auth::user()->vendor->id)
        {
            Storage::delete('images/service-images/'.$service->service_image);
            $service->delete();
            return redirect(route('showVendorServices'));
        }
        else
        {
            return back();
        }
    }

    /**
     * @param $vendorId
     * @param $serviceId
     * @param $charges
     * @return \Illuminate\Http\RedirectResponse
     */
    public function initializeTask($vendorId , $serviceId , $charges)
    {
        $userId = Auth::user()->id;
        $task = $this->_task->initializeTask($vendorId , $serviceId , $userId , $charges , TaskStatus::PENDING);

        $service = $this->_service->getService($serviceId);
        $vendor = $service->vendor;

        $msg = $task->user->name.' want to buy your service '.$task->service->title;
        $img =  $task->user->profile_photo;
        $task->vendor->notify(new PendingVendorTask($img,$msg,TaskStatus::PENDING));


        return redirect()->route('customerChat',compact('task'));
    }

}
