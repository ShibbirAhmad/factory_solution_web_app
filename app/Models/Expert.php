<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $table='experts';
    protected $fillable = ['id', 'user_id', 'department_id', 'designation_id', 'job_type', 'daily_working_hour', 'name', 'email', 'phone', 'nid', 'address', 'avatar', 'join_date', 'current_salary', 'per_hour_salary', 'total_bonus', 'total_salary', 'total_fine', 'total_paid', 'status', 'created_by', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function position(){
        return $this->belongsTo(Designation::class,'designation_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
