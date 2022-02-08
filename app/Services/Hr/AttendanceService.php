<?php
namespace  App\Services\Hr;
use App\Models\Attendance;
use App\Models\Expert;
use App\Services\ProductionSoftwareService;

class AttendanceService
{

    public static function saveOfficeInOutRecord($request)
    {
        $data = $request;
        $column_name = $request['isOut'] == 1 ? 'in_datetime' : 'out_datetime';
        $employee = Expert::query()->findOrFail($request['user_expert_id']);
        $data[$column_name] = $request['in_datetime'];
        $data['user_id'] = $employee->user_id ; // Employee boss user id
        $sliceDate = explode("T",$request['in_datetime']);
        $isAlreadyIn = Attendance::query()
            ->where('user_expert_id',$employee->id)
            ->where('in_datetime','LIKE','%'.$sliceDate[0].'%')
            ->OrWhere('out_datetime','LIKE','%'.$sliceDate[0].'%')
            ->first();

        $data['created_by'] = ProductionSoftwareService::merchantUserId();

        if(!empty($isAlreadyIn)){
            return $isAlreadyIn->update([$column_name=>$request['in_datetime']]);
        }else{
            return Attendance::query()->create($data);
        }
    }

    public static function updateOfficeInOutRecord($request,$id)
    {
        $column_name = $request['isOut'] == 1 ? 'in_datetime' : 'out_datetime';
        $employee = Expert::query()->findOrFail($request['user_expert_id']);
        $data[$column_name] = $request['in_datetime'];
        $data['created_by'] = ProductionSoftwareService::merchantUserId();
        $data['user_id'] = $employee->user_id ; // Employee boss user id
        $isAlreadyIn = Attendance::query()
                         ->findOrFail($id);
        return $isAlreadyIn->update([$column_name=>$request['in_datetime']]);
    }

}
