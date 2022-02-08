<?php


namespace App\Services\Prototype;

use App\Models\Prototype;
use App\Services\ProductionSoftwareService;
use App\Traits\StoreImageTrait;

class PrototypeService
{
    use StoreImageTrait;

    public function savePrototype($request,$folder){
        $data= $request;
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $data['ref_attachment'] = $this->imageProcess($request['ref_attachment'],$folder);
        return Prototype::query()->create($data);
    }


    public function imageProcess($file,$folder){
        return ($file ? $this->ImageStore($file,$folder,600,600) : null);
    }


}
