<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'invoice_no', 'supplier_invoice_no', 'user_id', 'supplier_id', 'qty', 'total', 'discount', 'paid', 'is_full_paid', 'payable_date', 'note', 'discount_note', 'created_by', 'created_at', 'updated_at', 'attachments'];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id') ;
    }



    public function purchaseItems(){
        return $this->hasMany(PurchaseProduct::class,'purchase_id') ;
    }


}
