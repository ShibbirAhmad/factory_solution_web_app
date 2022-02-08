<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::query()->orderBy('name')->get();
        return view('admin.category.index')->with($data);
    }

    public function store(CategoryStoreRequest $request){
        Category::query()->create($request->validated());
        session()->flash('success','Successfully Category Created');
        return redirect()->back();
    }

    public function edit($id){
        $data['category'] = Category::query()->findOrFail($id);
        $data['categories'] = Category::query()->orderBy('name')->get();
        return view('admin.category.edit-category')->with($data);
    }

    public function update(CategoryUpdateRequest $request,$id){
        $category = Category::query()->findOrFail($id);
        $category->update($request->validated());
        session()->flash('success','Successfully Category Updated.');
        return redirect()->route('category.add');
    }

    public function destroy(Request $request){
        $category = Category::query()->findOrFail($request->id);
        $category->delete();
        return response()->json(['success'=>'Data Deleted','code'=>200]);
    }

}
