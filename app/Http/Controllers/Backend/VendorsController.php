<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Service;
use App\Models\VendorVerificationTask;

class VendorsController extends Controller
{
    private $_vendor;
    private $_service;
    private $_vendorVerificationTask;

    /**
     * VendorsController constructor.
     * @param Vendor $vendor
     * @param Service $service
     * @param VendorVerificationTask $verificationTask
     */
    public function __construct(Vendor $vendor, Service $service, VendorVerificationTask $verificationTask){
        $this->_vendor = $vendor;
        $this->_service = $service;
        $this->_vendorVerificationTask = $verificationTask;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewVendorRequests(){
        $vendors = $this->_vendor->getPendingVendors();
        $services = $this->_service->getVendorsServices();
        return view('backend.vendor.view-vendor-requests')->with('data', ['vendors' => $vendors, 'services' => $services]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveVendor($id){
        $this->_vendor->approveVendor($id);
        $this->_service->activateService($id);
        return redirect()->route('viewVendorRequests');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelVendorRequest($id){
        $this->_vendor->cancelVendorRequest($id);
        return redirect()->route('viewVendorRequests');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyVendor($id){
        $this->_vendorVerificationTask->createTask($id);
        $this->_vendor->verifyVendor($id);
        return redirect()->route('viewVendorRequests');
    }

}
