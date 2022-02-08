<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentStoreRequest;
use App\Http\Requests\Department\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(){
        $data['departments'] = Department::query()->whereNull('parent_department_id')->orderBy('name')->get();
        return view('admin.department.index')->with($data);
    }

    public function store(DepartmentStoreRequest $request){
        Department::query()->create($request->validated());
        session()->flash('success','Successfully Department Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['department'] = Department::query()->findOrFail($id);
        $data['departments'] = Department::query()->whereNull('parent_department_id')->orderBy('name')->get();
        return view('admin.department.edit-department')->with($data);
    }

    public function update(DepartmentUpdateRequest $request,$id){
        $department = Department::query()->findOrFail($id);
        $department->update($request->validated());
        session()->flash('success','Successfully Department Updated.');
        return redirect()->route('department.add');
    }

    public function destroy(Request $request){
        $department = Department::query()->findOrFail($request->id);


        if($department->subDepartments->count()<=0) {
            $department->delete();
            return response()->json(['success' => 'Data Deleted', 'code' => 200]);
        }
    }

}
