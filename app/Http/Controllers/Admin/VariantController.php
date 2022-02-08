<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Variant\VariantStoreRequest;
use App\Http\Requests\Variant\VariantUpdateRequest;
use App\Models\Attribute;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::all();
        $attributes = Attribute::all();
        return view('admin.variant.index', compact('variants', 'attributes'));
    }

    public function store(VariantStoreRequest $request)
    {
        Variant::query()->create($request->validated());
        session()->flash('success', 'Successfully Variant created');
        return redirect()->back();
    }
    public function edit($id)
    {
        $data['attributes'] = Attribute::all();
        $data['variant'] = Variant::query()->findOrFail($id);
        $data['variants'] = Variant::query()->orderBy('name')->get();
        return view('admin.variant.edit-variant')->with($data);
    }

    public function update(VariantUpdateRequest $request, $id)
    {
        $variant = Variant::query()->findOrFail($id);
        $variant->update($request->validated());
        session()->flash('success', 'Successfully Variant Updated.');
        return redirect()->route('variant.index');
    }
}
