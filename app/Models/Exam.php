<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

  
   
    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }


    function exam_group_items(){
        return $this->hasMany(ExamGroupItem::class);
    }
}
