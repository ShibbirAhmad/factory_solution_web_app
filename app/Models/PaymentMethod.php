<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table='payment_methods';
    protected $fillable = ['name', 'account_no', 'isBank', 'created_by'];

    public function transactions(){
        return $this->hasMany(Cashbook::class,'payment_method_id');
    }

}
