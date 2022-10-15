<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroupItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_group_items';

    protected $fillable = [
        'exam_group_id',
        'exam_id',
        'academic_year_id'
    ];


    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    function academic_year(){
        return $this->belongsTo(AcademicYear::class);
    }

    function exam_group(){
        return $this->belongsTo(ExamGroup::class);
    }

    function exam_subjects(){
        return $this->hasMany(ExamSubject::class,'exam_group_item_id');
    }
    function exam_students(){
        return $this->hasMany(ExamStudent::class,'exam_group_item_id');
    }
    function exam_results(){
        return $this->hasMany(ExamResult::class,'exam_group_item_id');
    }
}
