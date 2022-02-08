<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\AttendanceStoreRequest;
use App\Http\Requests\Designation\DesignationStoreRequest;
use App\Http\Requests\Designation\DesignationUpdateRequest;
use App\Models\Attendance;
use App\Models\Designation;
use App\Models\Expert;
use App\Services\Hr\AttendanceService;
use App\Services\ProductionSoftwareService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        $data['attendances'] = Attendance::query()
            ->with('employee')
            ->where('user_id',ProductionSoftwareService::merchantUserId())
            ->orderBy('out_datetime')
            ->get();
        $data['employees'] = Expert::query()->where('user_id',auth()->id())->get();
        return view('admin.hr.attendance.index')->with($data);
    }

    public function store(AttendanceStoreRequest $request){
        $saveAttendance = (new AttendanceService())->saveOfficeInOutRecord($request->validated());
        session()->flash('success','Successfully Attendance Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['employees'] = Expert::query()
            ->where('user_id',ProductionSoftwareService::merchantUserId())
            ->get();
        $data['attendance'] = Attendance::query()->findOrFail($id);
        $data['attendances'] = Attendance::query()
            ->with('employee')
            ->where('user_id',ProductionSoftwareService::merchantUserId())
            ->orderBy('out_datetime')
            ->get();
        return view('admin.hr.attendance.edit-attendance')->with($data);
    }

    public function update(DesignationUpdateRequest $request,$id){
        $updateAttendance = (new AttendanceService())->updateOfficeInOutRecord($request->validated(),$id);
        session()->flash('success','Successfully Designation Updated.');
        return redirect()->route('designation.add');
    }

    public function destroy(Request $request){
        $attendance = Attendance::query()->findOrFail($request->id);
        $attendance->delete();
        return response()->json(['success'=>'Data Deleted','code'=>200]);
    }
}
