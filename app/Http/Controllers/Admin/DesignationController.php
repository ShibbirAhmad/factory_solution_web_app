<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Designation\DesignationStoreRequest;
use App\Http\Requests\Designation\DesignationUpdateRequest;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(){
        $data['designations'] = Designation::query()->orderBy('name')->get();
        return view('admin.designation.index')->with($data);
    }

    public function store(DesignationStoreRequest $request){
        Designation::query()->create($request->validated());
        session()->flash('success','Successfully Designation Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['designation'] = Designation::query()->findOrFail($id);
        $data['designations'] = Designation::query()->orderBy('name')->get();
        return view('admin.designation.edit-designation')->with($data);
    }

    public function update(DesignationUpdateRequest $request,$id){
        $designation = Designation::query()->findOrFail($id);
        $designation->update($request->validated());
        session()->flash('success','Successfully Designation Updated.');
        return redirect()->route('designation.add');
    }

    public function destroy(Request $request){
        $designation = Designation::query()->findOrFail($request->id);
        $designation->delete();
        return response()->json(['success'=>'Data Deleted','code'=>200]);
    }
}
