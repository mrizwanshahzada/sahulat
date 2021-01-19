<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VendorAddService;
// use Config;

class ServicesController extends FrontendController
{
    private $_service;

    /**
     * ServicesController constructor.
     * @param Service $service
     */
    function __construct(Service $service)
    {
        $this->_service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVendorServices()
    {
        $services = $this->_service->getVendorServices(Auth::user()->vendor->id);
        return view('frontend.vendor.dashboard.pages.show-vendor-services',)->with('services',$services);
    }

    /**
     * @param VendorAddService $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeService(VendorAddService $request)
    {
        $service = new Service();
        $service->vendor_id = Auth::user()->vendor->id;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->charges = $request->charges;
        $service->frequency = $request->frequency;
        $service->requirements = $request->requirements;
        $service->status = 'Active';
        $service->save();

        if ($request->hasFile('service_image')){
            $request->file('service_image')->storeAs('images/service-images', 'image'.$service->id.'.jpg');
            $fileName = 'image'.$service->id.'.jpg';
        }else{
            $fileName = 'no-image.jpg';
        }
        $service->service_image = $fileName;
        $service->save();

        return view('frontend.vendor.dashboard.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $sahulatServices=$this->_service->getServices("Sahulat");
        $vendorServices=$this->_service->getServices("Vendor");
        return view('frontend.service.services')->with(compact('sahulatServices','vendorServices'));;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function serviceDetails($id){
        $service = Service::find($id);

        if ($service->vendor_id == "") {
            # code...
            return view('frontend.service.service-details',compact('service'));
        }else{
            return view('frontend.service.service-vendor-detail',compact('service'));
        }

    }

}
