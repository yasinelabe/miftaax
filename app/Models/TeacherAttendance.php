<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'time_in',
        'time_out',
        'is_absent'
    ];


    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}