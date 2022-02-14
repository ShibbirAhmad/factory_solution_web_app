<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbook extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'invoice_no', 'purchase_id', 'supplier_id', 'order_id','client_id', 'sale_id', 'user_id', 'payment_method_id', 'amount', 'isDiscount', 'reference', 'isExpense', 'attachment', 'paid_date', 'is_salary_payment', 'note', 'created_by', 'created_at', 'updated_at'] ;


    public function createdBy(){

        return $this->belongsTo(User::class,'created_by')->select(['id','name']) ;

    }

    public function client(){

        return $this->belongsTo(Client::class,'client_id')->select(['id','name','company_name']) ;

    }

    public function supplier(){

        return $this->belongsTo(Supplier::class,'supplier_id')->select(['id','name']) ;

    }


    public function expert(){

        return $this->belongsTo(Expert::class,'expert_id')->select(['id','name']) ;

    }

    public function sale(){

        return $this->belongsTo(Sale::class,'sale_id')->select(['id','invoice_no']) ;

    }



    public function order(){

        return $this->belongsTo(Order::class,'order_id')->select(['id','invoice_no']) ;

    }


    public function purchase(){

        return $this->belongsTo(Purchase::class,'purchase_id')->select(['id','invoice_no']) ;

    }


    public function balance(){

        return $this->belongsTo(PaymentMethod::class,'payment_method_id')->select(['id','name']) ;

    }




}
