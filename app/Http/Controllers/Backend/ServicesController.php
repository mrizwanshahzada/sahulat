<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;

class ServicesController extends Controller
{
    private $_service;

    /**
     * ServicesController constructor.
     * @param Service $service
     */
    public function __construct(Service $service){
        $this->_service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewService(){
        return view('backend.service.add-new-service');
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewServices($type){
        $services = $this->_service->getServices($type);
        return view('backend.service.view-services')->with('data', ['services' => $services, 'type' => $type]);
    }

    /**
     * @param Service $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editService(Service $service){
        return view('backend.service.edit-service')->with('service', $service);
    }

    /**
     * @param StoreServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSahulatService(StoreServiceRequest $request){
        $this->_service->storeSahulatService($request);
        return redirect()->route('viewServices', 'Sahulat');
    }

    /**
     * @param StoreServiceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSahulatService(StoreServiceRequest $request, $id){
        $this->_service->updateSahulatService($request, $id);
        return redirect()->route('viewServices', 'Sahulat');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeSahulatService($id)
    {
        $this->_service->removeSahulatService($id);
        return redirect()->route('viewServices', 'Sahulat');
    }

}
