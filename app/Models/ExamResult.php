<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'exam_group_item_id',
        'student_id',
        'subject_id',
        'marks',
        'note',
        'grading_id',
        'is_absent'
    ];

    public function exam_group_item(){
        return $this->belongsTo(ExamGroupItem::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function exam_subject(){
        return $this->belongsTo(ExamSubject::class,'subject_id');
    }
    public function grading(){
        return $this->belongsTo(Grading::class,'grading_id');
    }
}