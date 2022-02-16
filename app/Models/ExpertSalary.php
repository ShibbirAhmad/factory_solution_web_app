<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertSalary extends Model
{
    use HasFactory;
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    
}
