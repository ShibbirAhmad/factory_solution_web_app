<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProgressReport extends Model
{
    use HasFactory;
    protected $table = 'order_progress_reports';
    protected $fillable = ['id', 'order_id', 'order_progress_id', 'department_id', 'expert_id', 'variant_id', 'task_qty', 'handover_qty', 'verified_by', 'note', 'created_at', 'updated_at'];


    public function variant(){
        return $this->belongsTo(Variant::class,'variant_id');
    }

    public function expert(){
        return $this->belongsTo(Expert::class,'expert_id');
    }


    public function verifiedBy(){
        return $this->belongsTo(User::class,'verified_by');
    }


}
