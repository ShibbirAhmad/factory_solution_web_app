<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $table='experts';
    protected $fillable = ['user_id', 'department_id','designation_id', 'name', 'email', 'phone', 'nid', 'address', 'avatar', 'join_date', 'current_salary', 'total_salary', 'total_fine', 'total_paid', 'status', 'created_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function position(){
        return $this->belongsTo(Designation::class,'designation_id');
    }

}
