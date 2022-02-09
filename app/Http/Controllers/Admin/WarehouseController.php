<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\WarehouseProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ProductionSoftwareService;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Warehouse\WarehouseStoreRequest;
use App\Http\Requests\Warehouse\WarehouseUpdateRequest;

class WarehouseController extends Controller
{



    public function index()
    {
        $data['warehouses'] = Warehouse::query()->orderBy('name')->get();
        return view('admin.warehouse.index')->with($data);
    }


    public function products()
    {
        $warehouse_id=Warehouse::where('user_id',auth()->id())->pluck('id');
        $data['products'] = WarehouseProduct::query()->whereIn('warehouse_id',$warehouse_id)
                                  ->select(DB::raw('product_id,warehouse_id'))
                                  ->groupBy('product_id','warehouse_id')
                                  ->get()->each(function($value){
                                    $value->{'variants'} = WarehouseProduct::where('warehouse_id',$value->warehouse_id)->where('product_id',$value->product_id)->select('variant_id','stock')->get();
                                  });


        return view('admin.warehouse.products')->with($data);
    }



    public function store(WarehouseStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        Warehouse::query()->create($data);
        session()->flash('success', 'Successfully Warehouse Created');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data['warehouse'] = Warehouse::query()->findOrFail($id);
        $data['warehouses'] = Warehouse::query()->orderBy('name')->get();
        return view('admin.warehouse.edit-warehouse')->with($data);
    }

    public function update(WarehouseUpdateRequest $request, $id)
    {
        $warehouse = Warehouse::query()->findOrFail($id);
        $data = $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $warehouse->update($data);
        session()->flash('success', 'Successfully Warehouse Updated.');
        return redirect()->route('warehouse.add');
    }

    public function destroy(Request $request)
    {
        $warehouse = Warehouse::query()->findOrFail($request->id);
        $warehouse->delete();
        return response()->json(['success' => 'Data Deleted', 'code' => 200]);
    }
}
