<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreServiceRequest;
use App\Utils\Globals\ServiceStatus;

class Service extends Model
{
    protected $fillable = [
        // frequency yet to be set
        'vendor_id', 'title','frequency', 'service_image', 'description', 'charges', 'requirements', 'status',
    ];

	public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @param $vendorId
     * @return Service[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getVendorServices($vendorId){
        return $this->all()->where('vendor_id', $vendorId);
    }

    /**
     * @return Service[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getVendorsServices(){
        return $this->all()->whereNotNull('vendor_id');
    }

    /**
     * @param $type
     * @return Service[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getServices($type){
        if ($type == 'Sahulat'){
            $services = $this->all()->where('vendor_id', null)->where('status',ServiceStatus::ACTIVE);
        }else{
            $services = $this->all()->whereNotNull('vendor_id')->where('status',ServiceStatus::ACTIVE);
        }
        return $services;
    }

    /**
     * @param StoreServiceRequest $request
     */
    public function storeSahulatService(StoreServiceRequest $request){

        $service = $this->create($request->all());

        if ($request->hasFile('service_image')){
            $path = $request->file('service_image')->storeAs('images/service-images', 'image'.$service->id.'.jpg');
            $service->service_image = 'image'.$service->id.'.jpg';
        }else{
            $service->service_image = 'no-image.jpg';
        }

        $service->service_image = 'image'.$service->id.'.jpg';
        $service->status = ServiceStatus::ACTIVE;
        $service->update();
    }

    /**
     * @param StoreServiceRequest $request
     * @param $id
     */
    public function updateSahulatService(StoreServiceRequest $request, $id){

        $service = $this->find($id);
        $service->update($request->all());

        if($request->hasFile('service_image')){
            Storage::delete('public/images/service-images/'.'image'.$service->id.'.jpg');
            $path = $request->file('service_image')->storeAs('images/service-images', 'image'.$service->id.'.jpg');
            $service->service_image = 'image'.$service->id.'.jpg';
            $service->update();
        }

    }

    /**
     * @param Service $service
     */
    public function updateVendorService(Service $service)
    {
         $service->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMyService ($id){

        $services =  $this->where('vendor_id' , $id)->get();
        // dd($services);
        return $services;
    }

    /**
     * @param $id
     */
    public function removeSahulatService($id)
    {
        $service = $this->find($id);
        Storage::delete('images/service-images/'.'image'.$service->id.'.jpg');
        $service->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getService($id)
    {
        # code...
        $service = $this->find($id);
        return $service;

    }

    /**
     * @param $id
     */
    public function activateService($id)
    {
        $vendorService = $this->where('vendor_id', $id)->first();
        $vendorService->status = 'Active';
        $vendorService->update();
    }


}
