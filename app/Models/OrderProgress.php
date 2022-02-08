<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProgress extends Model
{
    use HasFactory;
    protected $table = 'order_progress';
    protected $fillable = ['id', 'order_id', 'department_id', 'expert_id', 'unit_id', 'unit_qty', 'handover_date', 'progress_note', 'created_by', 'deleted_at', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function expert(){
        return $this->belongsTo(Expert::class,'expert_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }


    public function reports(){
        return $this->hasMany(OrderProgressReport::class,'order_progress_id');
    }


}
