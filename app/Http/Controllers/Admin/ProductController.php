<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;
use App\Models\WarehouseProduct;
use App\Http\Controllers\Controller;
use App\Services\ProductionSoftwareService;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class ProductController extends Controller
{
    use StoreImageTrait;
    public $uploadFolder = 'product';
    public function index(){
        $data['categories'] = Category::query()->orderBy('name')->pluck('name','id');
        $data['products'] = Product::query()->where('user_id',auth()->id())->orderBy('code')->get();
        return view('admin.product.index')->with($data);
    }

    public function store(ProductStoreRequest $request){
        $data = $request->validated();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $data['slug'] = Str::slug($request->name);
        $data['image'] = $this->imageProcess($request->file('image'));
        Product::query()->create($data);
        session()->flash('success','Successfully Product Created');
        return redirect()->route('product.add');
    }

    public function edit($id){
        $data['product'] = Product::query()->findOrFail($id);
        $data['categories'] = Category::query()->orderBy('name')->pluck('name','id');
        $data['products'] = Product::query()->where('user_id',auth()->id())->orderBy('code')->get();
        return view('admin.product.edit-product')->with($data);
    }

    public function update(ProductUpdateRequest $request,$id){
        $product = Product::query()->findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        $data['created_by'] = auth()->id();
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['image'] = $this->imageProcess($request->file('image'));
        /* New Image Found start  */
        if($request->hasFile('image')){
            /* Check Image column null or not.  If not null unlink it, otherwise store a new image  */
            if(!empty($product->image)){
                $path = public_path("storage/project_files/user".$product->user_id."/product/".$product->image);
                $this->UnlinkImage($path);
            }
        }
        /* New Image Found End */
        $product->update($data);
        session()->flash('success','Successfully Category Updated.');
        return redirect()->route('product.add');
    }

    public function imageProcess($file){
        return ($file ? $this->ImageStore($file,$this->uploadFolder,600,600) : null);
    }

    public function destroy(Request $request){
        $product = Product::query()->findOrFail($request->id);
        // Checking any purchase record found or not. If Any Purchase record found product will not be deleted.
        if($product->purchases && $product->purchases->count()>0){
            session()->flash('error','Product Can\t be delete.');
            return response()->json(['success'=>'Data not deleted','code'=>300]);
        }else{
            $product->delete();
            return response()->json(['success'=>'Data Deleted','code'=>200]);
        }
    }




    public function searchByCode($warehouse_id,$product_code){

          $product = Product::where('code',$product_code)->select('id','name','code','image')->first();
          if (!empty($product)) {
            $variants = WarehouseProduct::where('warehouse_id',$warehouse_id)->where('product_id',$product->id)->where('stock', '>',0)->select('variant_id','stock')->with('variant:id,name')->get();
            return response()->json([
                'status' => 1 ,
                'product' => $product ,
                'variants' => $variants,
            ]);
          }else{
             return response()->json([
                'status' => 0 ,
                'message' => 'product not found' ,
             ]);
          }
    }











}
