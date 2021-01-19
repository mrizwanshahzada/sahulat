<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;

class UsersController extends Controller
{
    private $_vendor;

    /**
     * UsersController constructor.
     * @param Vendor $vendor
     */
    public function __construct(Vendor $vendor){
        $this->_vendor = $vendor;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $vendor_requests = $this->_vendor->getPendingVendorsCount();
        return view('backend.pages.index')->with('vendor_requests', $vendor_requests);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminProfile(){
        return view('backend.user.admin-profile');
    }

}
