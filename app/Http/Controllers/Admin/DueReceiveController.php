<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\Log\LogTracker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ProductionSoftwareService;
use App\Http\Requests\DueReceive\StoreRequest;
use App\Services\Cashbook\CashBookService;

class DueReceiveController extends Controller
{


    public function index(){

        $payment_methods=PaymentMethod::orderBy('name')->get();
        return view('admin.due-receive.index',compact('payment_methods'));
    }


    public function searchDue(Request $request){

          if ($request->due_type=='sale') {
              # code...
          }else{
              $purchase=Purchase::where('user_id',ProductionSoftwareService::merchantUserId())
                                ->where('invoice_no',$request->invoice_no)->where('is_full_paid',0)->with('supplier','purchaseItems.product')->first();
              return response()->json([
                  'status' => 'purchase', //purchase status
                  'purchase' => $purchase,
              ]);
          }

    }




    public function store(StoreRequest $request){
         // return $request->validated();
       try {

           DB::beginTransaction();
           $data = $request->validated();
           $purchase=Purchase::where('invoice_no',$request->invoice_no)->first();
           $purchase->paid= floatval($purchase->paid) + floatval($data['amount']);
           $check_full_paid= floatval($purchase->total) -  (floatval($purchase->paid) + floatval($purchase->discount)) ;
           $purchase->is_full_paid= $purchase->total == $check_full_paid ? 1 : 0 ;
           $purchase->save();
           //storing in cashbook
           CashBookService::paymentStore($data,$purchase->invoice_no,1);
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
