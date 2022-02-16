<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\ExpertLeave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{


    public function index()
    {
        $employees = Expert::all();
        $leave_types = LeaveType::all();
        $expert_leaves = ExpertLeave::all();
        return view('admin.hr.leave.index', compact('employees', 'leave_types', 'expert_leaves'));
    }




    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
        ]);
        $leave = new ExpertLeave();
        $leave->expert_id = $request->expert_id;
        $leave->start_datetime = $request->start_datetime;
        $leave->end_datetime = $request->end_datetime;
        $leave->days = $request->days;
        $leave->leave_type = $request->leave_type;
        $leave->approved_by = Auth::user()->id;
        $leave->status = $request->status;
        $leave->save();
        return redirect()->back();
    }


    // public function edit($id)
    // {
    //     $data['leave'] = ExpertLeave::query()->findOrFail($id);
    //     $data['expert_leaves'] = ExpertLeave::query()->orderBy('name')->get();
    //     return view('admin.hr.leave-type.edit')->with($data);
    // }

    // public function update(Request $request, $id)
    // {
    //     $leave_type = ExpertLeave::findOrFail($id);
    //     $leave_type->name = $request->name;
    //     $leave_type->update();
    //     session()->flash('success', 'Successfully Leave Type Updated.');
    //     return redirect()->route('leaveType.add');
    // }


    

    public function destroy($id)
    {
        $leave_type = ExpertLeave::findOrFail($id);
        $leave_type->delete();
        return redirect()->back();
    }



}
