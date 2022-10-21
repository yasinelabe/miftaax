<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_room_id',
        'day',
        'time_in',
        'time_out'
    ];


    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function class_room(){
        return $this->belongsTo(ClassRoom::class);
    }
}