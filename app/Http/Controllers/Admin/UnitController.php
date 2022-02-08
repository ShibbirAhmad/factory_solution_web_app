<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\UnitStoreRequest;
use App\Http\Requests\Unit\UnitUpdateRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        $data['units'] = Unit::query()->orderBy('name')->get();
        return view('admin.unit.index')->with($data);
    }

    public function store(UnitStoreRequest $request){
        Unit::query()->create($request->validated());
        session()->flash('success','Successfully Unit Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['unit'] = Unit::query()->findOrFail($id);
        $data['units'] = Unit::query()->orderBy('name')->get();
        return view('admin.unit.edit-unit')->with($data);
    }

    public function update(UnitUpdateRequest $request,$id){
        $unit = Unit::query()->findOrFail($id);
        $unit->update($request->validated());
        session()->flash('success','Successfully Unit Updated.');
        return redirect()->route('unit.add');
    }

    public function destroy(Request $request){
        $unit = Unit::query()->findOrFail($request->id);
        $unit->delete();
        return response()->json(['success'=>'Data Deleted','code'=>200]);
    }
}
