<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=['invoice_no','attribute_id', 'prototype_id', 'unit_id', 'product_id', 'title', 'start_datetime', 'end_datetime', 'qty', 'total', 'expected_qty', 'produced_qty', 'produced_per_product_price', 'attachments', 'order_agreements', 'is_closed', 'user_id', 'created_by', 'deleted_at'];

    public function prototype(){
        return $this->belongsTo(Prototype::class,'prototype_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function createBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function tasks(){
        return $this->hasMany(ProductionHouseOrderProgress::class,'order_id');
    }

    public function variants(){
        return $this->hasMany(OrderVariant::class,'order_id')->select(['id','order_id','variant_id','except_qty','handover_qty']);
    }


}
