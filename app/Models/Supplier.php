<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    protected $fillable=['user_id', 'name', 'avatar', 'email', 'phone', 'nid', 'address', 'status', 'total_amount', 'total_discount', 'total_paid', 'created_by'];
}
