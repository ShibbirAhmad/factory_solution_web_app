<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable = ['category_id', 'code', 'name', 'slug', 'image', 'details', 'created_by','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function purchases(){
        return $this->hasMany(PurchaseProduct::class,'product_id');
    }

}
