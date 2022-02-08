<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table='attendances';
    protected $fillable=[ 'iot_device_id', 'user_id', 'user_expert_id', 'in_datetime', 'out_datetime', 'is_paid_leave_record', 'created_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employee(){
        return $this->belongsTo(Expert::class,'user_expert_id');
    }

}
