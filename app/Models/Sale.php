<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $fillable=['id', 'user_id', 'client_id', 'invoice_no', 'total', 'paid', 'discount', 'created_by', 'note', 'created_at', 'updated_at'];
    use HasFactory;



    public function createdBy(){

        return $this->belongsTo(User::class,'user_id')->select(['id','name']) ;

    }

    public function client(){

        return $this->belongsTo(Client::class,'client_id')->select(['id','name','phone','company_name']) ;

    }


    public function items(){

        return $this->hasMany(SaleItem::class,'sale_id')->select(['id','sale_id','price','product_id','variant_id','qty']) ;

    }




}
