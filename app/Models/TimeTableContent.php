<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTableContent extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "teacher_id",
        'subject_id',
        'time_table_id',
        "day",
        "starting_time",
        "ending_time"
    ];

    function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    function subject(){
        return $this->belongsTo(Subject::class);
    }

    function timetable(){
        return $this->belongsTo(TimeTable::class);
    }
    
}
