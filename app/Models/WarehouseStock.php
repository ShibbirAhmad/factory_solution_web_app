<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'warehouse_id', 'order_id', 'product_id', 'total_qty', 'created_at', 'updated_at'];
}
