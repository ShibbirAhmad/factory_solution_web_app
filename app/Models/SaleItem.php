<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable=['id', 'sale_id', 'product_id', 'variant_id', 'price', 'qty', 'created_at', 'updated_at'] ;


    public function product(){
        return $this->belongsTo(Product::class,'product_id')->select(['id','name','image']) ;
    }


    public function variant(){

          return $this->belongsTo(Variant::class,'variant_id') ;
     }



}
