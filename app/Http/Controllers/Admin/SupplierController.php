<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Services\ProductionSoftwareService;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierStoreRequest;
use App\Http\Requests\supplier\SupplierUpdateRequest;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{

    use StoreImageTrait;
    public $uploadFolder = 'supplier';
    public function index()
    {
        $suppliers = Supplier::orderBy('id','desc')->get();
        return view('admin.supplier.suppliers')->with(['suppliers'=>$suppliers]) ;
    }

    public function create()
    {
          return view('admin.supplier.add-supplier');
    }


    public function store(SupplierStoreRequest $request)
    {
        $data= $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id() ;
        $data['avatar'] = $this->imageProcess($request->file('avatar'));
        Supplier::query()->create($data);
        session()->flash('success','supplier created successfully');
        return redirect()->route('supplier.index');
    }


    public function imageProcess($file){
        return ($file ? $this->ImageStore($file,$this->uploadFolder,250,250) : null);
    }

    public function show($id)
    {
        $data['supplier'] = Supplier::findOrFail($id);
        $data['purchase_amount'] = DB::table('suppliers')->where('id', $id)->sum('total_amount');
        $data['paid_amount'] = DB::table('suppliers')->where('id', $id)->sum('total_paid');
        $data['purchases'] = Purchase::where('supplier_id', $id)->get();
        return view('admin.supplier.show')->with($data);
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit-supplier')->with(['supplier' => $supplier]);
    }


    public function update(SupplierUpdateRequest $request,$id)
    {
        $supplier=Supplier::query()->findOrFail($id);
        $data= $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['avatar'] = $this->imageProcess($request->file('avatar'));
        /* olf image deleting start  */
        if($request->hasFile('avatar')){
            /* Check Image column null or not.  If not null unlink it, otherwise store a new image  */
            if(!empty($supplier->avatar)){
                $path = public_path("storage/project_files/user".$supplier->user_id."/supplier/".$supplier->avatar);
                $this->UnlinkImage($path);
            }
        }
        /* End */
        $supplier->update($data);
        session()->flash('success','supplier info updated');
        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
