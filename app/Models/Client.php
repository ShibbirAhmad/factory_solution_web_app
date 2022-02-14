<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'name', 'company_name', 'phone', 'total_amount', 'total_paid', 'address', 'created_at', 'updated_at'];
}
