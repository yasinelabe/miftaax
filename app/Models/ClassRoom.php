<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'academic_year_id',
        'shift_id'
    ];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class,'academic_year_id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class,'shift_id');
    }

    public function students(){
        return $this->belongsToMany(Student::class,'student_class_rooms');
    }
   
}