<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClassRoom extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "student_id",
        "class_room_id"
    ];


    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function class_room(){
        return $this->belongsTo(ClassRoom::class);
    }
}
