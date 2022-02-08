<?php
namespace App\Services\Order;
use App\Models\Order;
use App\Models\OrderVariant;
use App\Services\ProductionSoftwareService;

class OrderService
{

    //  Order::query()->where('invoice_no',$invoice_no)->first() ? ($invoice_no+52) : $invoice_no;

    public function saveOrder($request){
        $data = $request;
        $invoice_no  = ProductionSoftwareService::uniqueInvoiceNoMaker(4);
        $data['user_id'] = ProductionSoftwareService::merchantUserId();
        $data['created_by'] = auth()->id();
        $data['invoice_no'] = $invoice_no;
        return Order::query()->create($data);
    }
}
