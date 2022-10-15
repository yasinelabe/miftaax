<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'attendance_date',
        'class_room_id'
    ];

    public function class_room(){
        return $this->belongsTo(ClassRoom::class,'class_room_id');
    }
}