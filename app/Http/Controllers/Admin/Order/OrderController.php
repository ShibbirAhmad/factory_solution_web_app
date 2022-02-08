<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Unit;
use App\Models\Order;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Prototype;
use Illuminate\Http\Request;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Department;
use App\Models\OrderProgress;
use App\Models\OrderProgressReport;
use App\Models\OrderVariant;
use App\Models\Variant;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;
use App\Models\WarehouseStock;
use Throwable;

class OrderController extends Controller
{

    public function index(){

        $data['products'] = Product::query()->with(['category'])->orderBy('code')->get();
        $data['units'] = Unit::query()->orderBy('name')->pluck('name','id');
        $data['prototypes'] = Prototype::query()->orderBy('code')->get();
        $data['attributes'] = Attribute::query()->get();
        $data['variants'] = Variant::query()->where('attribute_id',1)->get();
        return view('admin.order.index')->with($data);

    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required',
            'product_id'=>'required',
            'attribute_id'=>'required',
            'unit_id'=>'required',
            'expected_qty'=>'required',
            'start_datetime'=>'required',
            'end_datetime'=>'required',
            'prototype_id'=>'required',
            'order_agreements'=>'nullable',
        ]);

        DB::beginTransaction();
        try {
            $order = (new OrderService())->saveOrder($data);
            //save order variants and expected quantity
            $variant_data =json_decode($request->order_variant_and_qty, true);
            for($v=0; $v < count((array)$variant_data) ; $v++) {
                $order_variant = new OrderVariant() ;
                $order_variant->order_id =  $order->id ;
                $order_variant->variant_id =  $variant_data[$v]['variant_id'] ;
                $order_variant->except_qty =  $variant_data[$v]['except_qty'] ;
                $order_variant->save();
            }
            DB::commit();
            session()->flash('success','Successfully Production Order Created.');
            return redirect()->route('order.list');
        }
        catch (\Exception $e){
            LogTracker::failLog($e,auth()->id());
            DB::rollBack();
            session()->flash('error','Production Order Not created.');
            return redirect()->route('order.add');
        }

    }

    public function list(){
        $data['orders'] = Order::query()->with(['prototype','unit','product','createBy'])->orderByDesc('id')->get();
        return view('admin.order.orders')->with($data);
    }

    public function edit($id){

    }

    public function update(Request $request,$id){

    }

    public function destroy(Request $request){

    }




    public function departmentWiseReport($order_id){

        $data['order'] = Order::query()->where('user_id',auth()->id())->where('id',$order_id)->with(['product:id,code,image','prototype:id,code,ref_attachment','variants'])->first();

        $data['order_reports']= OrderProgress::where('order_id',$data['order']->id)->select(DB::raw('count(*) as total_assigned, department_id, order_id'))
                                 ->groupBy('department_id','order_id')->get('department_id')->each(function($value){
                                     $value->{'tasks'} = OrderProgressReport::where('order_id',$value->order_id)->where('department_id',$value->department_id)->select(DB::raw('variant_id,SUM(task_qty) as total_task_assigned_qty, SUM(handover_qty) as total_received_qty'))->groupBy('variant_id')->get();
                                  });
        $data['warehouses'] = Warehouse::where('user_id',auth()->id())->get();
        $data['order_variants'] = OrderVariant::where('order_id',$data['order']->id)->get();
        $data['total_task_qty'] = $data['order_variants']->sum('except_qty');

        return view('admin.order.completion.group-report-and-completion')->with($data);

    }




    public function completeAndStockInProduct(Request $request,$order_id){

            $data = $request->validate([
               'warehouse_id' => 'required',
               'note' => 'nullable',
            ]);
            DB::beginTransaction();
            try{
                //firstly close the order
                $order = Order::findOrFail($order_id);
                $order->is_closed = 1 ;
                $order->save();
                //save order report
                $variant_data =json_decode($request->order_variant_and_qty, true);
                for($v=0; $v < count((array)$variant_data) ; $v++) {
                    $order_variant = OrderVariant::where('order_id',$order->id)->where('variant_id', $variant_data[$v]['variant_id'])->first() ;
                    $order_variant->handover_qty =  $variant_data[$v]['handover_qty'] ;
                    $order_variant->save();
                    //warehouse product variant stocking in.
                    $product_variant = WarehouseProduct::where('product_id',$order->product_id)->where('variant_id', $order_variant->variant_id)->first();
                    if (!empty($product_variant)) {
                        $product_variant->stock = intval($product_variant->stock) + intval($order_variant->handover_qty) ;
                        $product_variant->save();
                    } else {
                        $product = new WarehouseProduct() ;
                        $product->warehouse_id = $request->warehouse_id ;
                        $product->product_id = $order->product_id ;
                        $product->variant_id =  $order_variant->variant_id ;
                        $product->stock = $order_variant->handover_qty;
                        $product->save();
                    }

                }
                //warehouse stock record
                $w_stock = new WarehouseStock() ;
                $w_stock->warehouse_id = $request->warehouse_id ;
                $w_stock->order_id = $order->id ;
                $w_stock->product_id = $order->product_id ;
                $w_stock->total_qty = OrderVariant::where('order_id',$order->id)->sum('handover_qty') ;
                $w_stock->note = $request->note ?? null ;
                $w_stock->save();

                DB::commit();
                session()->flash('success','Order Completed.');
                return redirect()->route('order.list');

            }catch(Throwable $e){

                DB::rollBack();
                LogTracker::failLog($e,auth()->id()) ;
                session()->flash('error','Order completion failed.');
                return redirect()->back();

            }
    }








}
