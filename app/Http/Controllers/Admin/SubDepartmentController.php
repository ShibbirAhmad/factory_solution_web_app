<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubDepartment\SubDepartmentStoreRequest;
use App\Http\Requests\SubDepartment\SubDepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    public function index(){
        $data['departments'] = Department::query()->orderBy('name')->pluck('name','id');
        $data['sub_departments'] = Department::query()
            ->with('department')
            ->whereNotNull('parent_department_id')
            ->get();

        return view('admin.sub-department.index')->with($data);
    }

    public function store(SubDepartmentStoreRequest $request){
        Department::query()->create($request->validated());
        session()->flash('success','Successfully Sub-Department Created');
        return redirect()->route('subDepartment.add');
    }

    public function edit($id){
        $data['sub_department'] = Department::query()->findOrFail($id);
        $data['departments'] = Department::query()->orderBy('name')->pluck('name','id');
        $data['sub_departments'] = Department::query()
            ->with('department')
            ->whereNotNull('parent_department_id')
            ->get();
        return view('admin.sub-department.edit-sub-department')->with($data);
    }

    public function update(SubDepartmentUpdateRequest $request,$id){
        $department = Department::query()->findOrFail($id);
        $department->update($request->validated());
        session()->flash('success','Successfully Department Updated.');
        return redirect()->route('subDepartment.add');
    }

    public function destroy(Request $request){
        $department = Department::query()->findOrFail($request->id);
        $department->delete();
        return response()->json(['success'=>'Data Deleted','code'=>200]);
    }
}
