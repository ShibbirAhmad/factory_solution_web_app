<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertSalary extends Model
{
    use HasFactory;
    protected $fillable = ['expert_id', 'bonus', 'fine', 'amount', 'payment_method_id', 'comment'];
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    
}
