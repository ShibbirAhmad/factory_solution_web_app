<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Cashbook\CashBookService;
use App\Services\ProductionSoftwareService;
use App\Http\Requests\DueReceive\StoreRequest;

class DueReceiveController extends Controller
{


    public function index(){

        $payment_methods=PaymentMethod::orderBy('name')->get();
        return view('admin.due-receive.index',compact('payment_methods'));
    }


    public function searchDue(Request $request){

          if ($request->due_type=='sale') {
             $sale= Sale::where('user_id',auth()->id())->where('invoice_no',$request->invoice_no)->where('is_full_paid',0)->with('client')->first();
             if (!empty($sale)) {
                $sale_items = SaleItem::query()->where('sale_id',$sale->id)->select(DB::raw('product_id'))->groupBy('product_id')
                                        ->get()->each(function($value){
                                        $value->{'variants'} = SaleItem::where('product_id',$value->product_id)->select('variant_id','product_id','price','qty')->with(['variant:id,name','product:id,name,code,image'])->get();
                                });
                return response()->json([
                    'status' => 'sale',
                    'sale' => $sale,
                    'sale_items' => $sale_items,
                ]);
             }

            }else{
              $purchase=Purchase::where('user_id',ProductionSoftwareService::merchantUserId())
                                ->where('invoice_no',$request->invoice_no)->where('is_full_paid',0)->with('supplier','purchaseItems.product')->first();
              return response()->json([
                  'status' => 'purchase',
                  'purchase' => $purchase,
              ]);
          }

    }




    public function store(StoreRequest $request){
         // return $request->validated();
       try {

           DB::beginTransaction();
           $data = $request->validated();
           $invoice_no= '' ;
           $store_type= 0 ;
           if ($data['due_type']=='sale') {

                $sale=Sale::where('invoice_no',$request->invoice_no)->first();
                $sale->paid= floatval($sale->paid) + floatval($data['amount']);
                $check_full_paid= intval($sale->total) -  (intval($sale->paid)  + intval($sale->discount)) ;
                $sale->is_full_paid= $sale->total == $check_full_paid ? 1 : 0 ;
                $sale->save();
                $invoice_no=$sale->invoice_no ;
                $store_type=2 ;
                //updating client paid amount
                $client = Client::findOrFail($sale->client_id);
                $client->total_paid = floatval($client->total_paid) + floatval($data['amount']);
                $client->save();

           }else if ($data['due_type']=='purchase') {

                $purchase=Purchase::where('invoice_no',$request->invoice_no)->first();
                $purchase->paid= floatval($purchase->paid) + floatval($data['amount']);
                $check_full_paid= intval($purchase->total) -  (intval($purchase->paid) + intval($purchase->discount)) ;
                $purchase->is_full_paid= $purchase->total == $check_full_paid ? 1 : 0 ;
                $purchase->save();
                $invoice_no=$purchase->invoice_no ;
                $store_type=1 ;
                //updating supplier paid amount
                $supplier = Supplier::findOrFail($purchase->supplier_id);
                $supplier->total_paid = floatval($supplier->total_paid) + floatval($data['amount']);
                $supplier->save();
           }

           //storing in cashbook
           CashBookService::paymentStore($data,$invoice_no,$store_type);
           DB::commit();
           return response()->json([
               'status' => 1,
               'message' => 'transaction successful'
           ]);
       } catch (\Throwable $e) {
          LogTracker::failLog($e,ProductionSoftwareService::merchantUserId());
          DB::rollBack();
       }

    }







}
