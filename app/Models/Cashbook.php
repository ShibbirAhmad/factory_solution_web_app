<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbook extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'invoice_no', 'purchase_id', 'supplier_id', 'order_id','client_id', 'sale_id', 'user_id', 'payment_method_id', 'amount', 'isDiscount', 'reference', 'isExpense', 'attachment', 'paid_date', 'is_salary_payment', 'note', 'created_by', 'created_at', 'updated_at'] ;
}
