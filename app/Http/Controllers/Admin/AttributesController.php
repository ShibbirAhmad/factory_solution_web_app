<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Requests\Attribute\AttributeStoreRequest;
use App\Http\Requests\Attribute\AttributeUpdateRequest;

class AttributesController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.attribute.index', compact('attributes'));
    }

    public function store(AttributeStoreRequest $request)
    {
        Attribute::query()->create($request->validated());
        session()->flash('success', 'Successfully Attribute created');
        return redirect()->back();
    }
    public function edit($id)
    {
        $data['attribute'] = Attribute::query()->findOrFail($id);
        $data['attributes'] = Attribute::query()->orderBy('name')->get();
        return view('admin.attribute.edit-attribute')->with($data);
    }

    public function update(AttributeUpdateRequest $request, $id)
    {
        $attribute = Attribute::query()->findOrFail($id);
        $attribute->update($request->validated());
        session()->flash('success', 'Successfully Attribute Updated.');
        return redirect()->route('attribute.index');
    }

}
