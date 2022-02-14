<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PurchaseProduct;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ProductionSoftwareService;
use App\Http\Requests\Purchase\PurchaseStoreRequest;
use App\Models\Cashbook;
use App\Services\Cashbook\CashBookService;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['purchases'] = Purchase::all();
        $data['due'] = 0;
        return view('admin.purchase.index')->with($data);
    }


    public function create()
    {
         $data['products']=Product::query()->where('user_id',ProductionSoftwareService::merchantUserId())->get();
         $data['suppliers']=Supplier::query()->where('user_id',ProductionSoftwareService::merchantUserId())->get();
         $data['units']=Unit::query()->get();
         $data['payment_methods']=PaymentMethod::orderBy('name')->get();
         return view('admin.purchase.create-purchase')->with($data) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseStoreRequest $request)
    {
            DB::beginTransaction();
            try {
                $data=$request->validated() ;
                $data['invoice_no'] = ProductionSoftwareService::uniqueInvoiceNoMaker(2);
                $data['user_id'] = ProductionSoftwareService::merchantUserId();
                $data['created_by'] = auth()->id();
                $data['total'] = array_sum(array_column($data['purchase_items'],'amount'));
                $data['qty'] = array_sum(array_column($data['purchase_items'],'qty'));
                $purchase=Purchase::query()->create($data);
                //inserting purchase items
                foreach ($data['purchase_items'] as $key => $item) {
                    $p_item['purchase_id'] = $purchase->id ;
                    $p_item['user_id'] = ProductionSoftwareService::merchantUserId();
                    $p_item['created_by'] = auth()->id();
                    $p_item['product_id'] = $item['product_id'] ;
                    $p_item['qty'] = $item['qty'] ;
                    $p_item['price'] = $item['price'] ;
                    PurchaseProduct::query()->create($p_item);
                }
                    //updating supplier records
                    $supplier=Supplier::findOrFail($data['supplier_id']);
                    $supplier->total_amount = intval( $supplier->total_amount) + intval($data['amount']) ;
                    $supplier->total_discount = intval( $supplier->total_discount) + intval($data['discount']) ;
                    $supplier->total_paid = intval( $supplier->total_paid) + intval($data['paid']) ;
                    $supplier->save();
                //storing cashbook of debit amount
                if ($data['payment_method'] && $data['paid'] > 0) {
                    $data['amount'] = $data['paid'] ;
                    $data['due_type'] = 'purchase' ;
                    $data['is_discount_payment'] = 0 ;
                    CashBookService::paymentStore($data,$purchase->invoice_no,1) ;
                }
                DB::commit();
                return response()->json([
                    "status" => 1,
                    "message" => "Purchase added successfully"
                ]);
            } catch (\Throwable $e) {
                LogTracker::failLog($e,ProductionSoftwareService::merchantUserId());
                DB::rollBack();
            }
    }

    public function show($id)
    {
        $data['purchase'] = Purchase::with('purchaseItems.product')->findOrFail($id);
        return view('admin.purchase.show')->with($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
