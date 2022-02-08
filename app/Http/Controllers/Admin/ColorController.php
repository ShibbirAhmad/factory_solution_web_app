<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorStoreRequest;
use App\Http\Requests\Color\ColorUpdateRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $data['colors'] = Color::query()->orderBy('name')->get();
        return view('admin.color.index')->with($data);
    }
    public function store(ColorStoreRequest $request)
    {
        Color::query()->create($request->validated());
        session()->flash('success', 'Successfully color created');
        return redirect()->back();
    }
    public function edit($id)
    {
        $data['color'] = Color::query()->findOrFail($id);
        $data['colors'] = Color::query()->orderBy('name')->get();
        return view('admin.color.edit-color')->with($data);
    }
    public function update(ColorUpdateRequest $request, $id)
    {
        $color = Color::query()->findOrFail($id);
        $color->update($request->validated());
        session()->flash('success', 'Successfully Color Updated.');
        return redirect()->route('color.add');
    }
    public function destroy(Request $request)
    {
        $color = Color::query()->findOrFail($request->id);
        $color->delete();
        return response()->json(['success' => 'Data Deleted', 'code' => 200]);
    }
}
