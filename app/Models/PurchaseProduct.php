<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PurchaseProduct extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'purchase_id', 'product_id', 'qty', 'price', 'created_by', 'created_at', 'updated_at'] ;



    public function product(){
        return $this->belongsTo(Product::class,'product_id')->select(['id','name']) ;
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }

    
}
