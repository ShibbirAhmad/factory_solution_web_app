<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table='departments';
    protected $fillable = ['name', 'image', 'parent_department_id', 'deleted_at'];

    public function department(){
        return $this->belongsTo(Department::class,'parent_department_id');
    }

    public function subDepartments(){
        return $this->hasMany(Department::class,'parent_department_id');
    }

    public function departments(){
        return $this->hasMany(Department::class,'parent_department_id');
    }

    public function experts(){
        return $this->hasMany(Expert::class,'department_id');
    }



}
