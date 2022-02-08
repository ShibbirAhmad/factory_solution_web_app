<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderVariant extends Model
{
    use HasFactory;

    protected $fillable = ['id','order_id','variant_id','except_qty', 'handover_qty', 'created_at', 'updated_at'] ;


    public function variant(){

          return $this->belongsTo(Variant::class,'variant_id','id')->select(['id','name']) ;
    }

}
