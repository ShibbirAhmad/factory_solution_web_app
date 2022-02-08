<?php

 namespace App\Services\Cashbook ;
use App\Models\Order;
use App\Models\Cashbook;
use App\Models\Purchase;
use App\Models\PaymentMethod;
use App\Services\ProductionSoftwareService;



 class CashBookService{


      public static function paymentStore($data,$invoice_no_type){

            //storing in cashbook
           $purchase=Purchase::where('invoice_no',$data['invoice_no'])->first();
          // $order=Order::findOrFail($data['order_id']);
           $payment_method=PaymentMethod::findOrFail($data['payment_method']);
           $data['invoice_no'] = ProductionSoftwareService::uniqueInvoiceNoMaker($invoice_no_type);
           $data['purchase_id'] = $purchase->id  ?? null;
           $data['order_id'] = null ;
           $data['supplier_id'] = $purchase->supplier_id ?? null ;
           $data['user_id'] = ProductionSoftwareService::merchantUserId();
           $data['payment_method_id'] = $payment_method->id;
           $data['amount'] = $data['amount'];
           $data['isDiscount'] = $data['is_discount_payment'] = 1 ? $data['amount'] : 0;
           $data['reference'] = $data['transaction_id'] ?? null;
           $data['isExpense'] = $data['due_type'] == 'purchase' ? 1 : 0 ;
           $data['paid_date'] = $data['paid_date'] ?? null;
           $data['note'] = $data['note'] ?? null;
           return  Cashbook::query()->create($data);

      }



}






?>