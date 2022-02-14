<?php

 namespace App\Services\Cashbook ;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Cashbook;
use App\Models\Purchase;
use App\Models\PaymentMethod;
use App\Services\ProductionSoftwareService;



 class CashBookService{


      public static function paymentStore($data,$invoice_no,$store_type){

            //storing in cashbook
            //the parameter invoice no is purchase/sale or other invoice_no
            //store_type 1 = purchase related store
            //store_type 2 = sale related store


            $payment_method=PaymentMethod::findOrFail($data['payment_method']);
            $data['invoice_no'] = ProductionSoftwareService::uniqueInvoiceNoMaker(1);
            $data['user_id'] = ProductionSoftwareService::merchantUserId();
            $data['payment_method_id'] = $payment_method->id;
            $data['amount'] = $data['amount'];
            $data['isDiscount'] = $data['is_discount_payment'] = 1 ? 1 : 0;
            $data['reference'] = $data['transaction_id'] ?? null;
            $data['isExpense'] = $data['due_type'] == 'purchase' ? 1 : 0 ;
            $data['paid_date'] = $data['paid_date'] ?? null;
            $data['note'] = $data['note'] ?? null;

           if($store_type==1){

                  $purchase=Purchase::where('invoice_no',$invoice_no)->first();
                  $data['purchase_id'] = $purchase->id  ?? null;
                  $data['order_id'] = null ;
                  $data['sale_id'] = null ;
                  $data['client_id'] = null ;
                  $data['supplier_id'] = $purchase->supplier_id ?? null ;
                  Cashbook::query()->create($data);

           }else if ($store_type==2){

                  $sale=Sale::where('invoice_no',$invoice_no)->first();
                  $data['purchase_id'] =  null;
                  $data['order_id'] = null ;
                  $data['sale_id'] = $sale->id ;
                  $data['client_id'] = $sale->client_id ;
                  $data['supplier_id'] = null ;
                  Cashbook::query()->create($data);

           }

           return ;

      }



}






?>