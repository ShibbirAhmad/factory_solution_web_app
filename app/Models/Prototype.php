<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototype extends Model
{
    use HasFactory;
    protected $table='prototypes';
    protected $fillable=['code', 'title', 'type', 'user_id', 'total_used', 'status', 'ref_attachment', 'ref_link', 'note', 'verification_note', 'proto_type_verified_at', 'created_by', 'approved_by', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function designer(){
        return $this->belongsTo(Expert::class,'user_id');
    }

}
