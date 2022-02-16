<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertLeave extends Model
{
    use HasFactory;
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    
}
