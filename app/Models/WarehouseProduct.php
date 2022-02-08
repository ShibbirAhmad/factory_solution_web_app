<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    use HasFactory;

     protected $fillable =['id', 'warehouse_id', 'product_id', 'variant_id', 'stock', 'created_at', 'updated_at'] ;
}
