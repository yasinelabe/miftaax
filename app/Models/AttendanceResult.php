<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceResult extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "attendance_results";

    protected $fillable = [
        'attendance_id',
        'student_id',
        'attendance_result_status_id',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function attendance(){
        return $this->belongsTo(Attendance::class);
    }
    public function attendance_result_status(){
        return $this->belongsTo(AttendanceResultStatus::class,'attendance_result_status_id');
    }

    
}