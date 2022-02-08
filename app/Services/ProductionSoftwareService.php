<?php
namespace App\Services;

use App\Models\Cashbook;
use App\Models\Order;
use App\Models\Purchase;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\This;

class ProductionSoftwareService
{
    public static function productCode($code){

    }

    public static function merchantUserId()
    {
        return auth()->id();
    }

    public static function randomNumber(){
        return 2022+rand(11,99);
    }

    public static function fileUploadFolder($folderType)
    {
        $folders = ["supplier","product","employee","design"];
        foreach ($folders as $key=>$value){
            if($key == $folderType){
                return $value;
            }
        }
    }

    public static function  orderInvoiceNo()
    {
        return 5252;
    }

    public static function uniqueInvoiceNoMaker($invoice_no_type){
        /*
            Notes for $invoice_no_type
            $invoice_no_type == 1 means cashbooks table invoice no
            $invoice_no_type == 2 means purchases table invoice no
            $invoice_no_type == 3 means sales table invoice no
            $invoice_no_type == 4 means Production orders/orders table invoice no
        */
        // 5252_CB_5689
        // 5252-2536
        $invoice_no = self::orderInvoiceNo()."_".self::dynamicCashFlowName($invoice_no_type)."_".rand(111,9999);

        if($invoice_no_type == 1)
        {
            $isExists = self::isExist(new Cashbook(),'invoice_no',$invoice_no);
            return !empty($isExists) ? self::uniqueInvoiceNoMaker($invoice_no_type) : $invoice_no;
        }elseif($invoice_no_type == 2)
        {
            $isExists = self::isExist(new Purchase(),'invoice_no',$invoice_no);
            return !empty($isExists) ? self::uniqueInvoiceNoMaker($invoice_no_type) : $invoice_no;
        }
        elseif($invoice_no_type == 3)
        {
            // Sale not integrated yet.
//            $isExists = self::isExist(new Sale(),'invoice_no',$invoice_no);
//            return !empty($isExists) ? self::uniqueInvoiceNoMaker($invoice_no_type) : $invoice_no;
        }
        else if ($invoice_no_type == 4){
            $isExists = self::isExist(new Order(),'invoice_no',$invoice_no);
            return !empty($isExists) ? self::uniqueInvoiceNoMaker($invoice_no_type) : $invoice_no;
        }
    }

    public static function dynamicCashFlowName($type){
        return ($type == 1 ? "CB" : /* Cashbook else start */ ($type == 2 ? "PUR" : /* purchase else start*/ ( $type == 3 ? "SLS" : "PO" ) ));
    }

    public static function isExist($model,$column,$invoice_no){
        return $model->where($column,$invoice_no)->first() ?? null;
    }
}
