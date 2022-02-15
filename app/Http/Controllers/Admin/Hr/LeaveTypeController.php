<?php

namespace App\Http\Controllers\Admin\Hr;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveType\LeaveTypeStoreRequest;
use App\Http\Requests\LeaveType\LeaveTypeUpdateRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.hr.leave-type.index', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $leave = new LeaveType();
        $leave->name = $request->name;
        $leave->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $data['leave_type'] = LeaveType::query()->findOrFail($id);
        $data['leaveTypes'] = LeaveType::query()->orderBy('name')->get();
        return view('admin.hr.leave-type.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $leave_type = LeaveType::findOrFail($id);
        $leave_type->name = $request->name;
        $leave_type->update();
        session()->flash('success', 'Successfully Leave Type Updated.');
        return redirect()->route('leaveType.add');
    }

    public function destroy($id)
    {
        $leave_type = LeaveType::findOrFail($id);
        $leave_type->delete();
        return redirect()->back();
    }
}
