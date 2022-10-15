<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_subjects';

    public $fillable = [
        'exam_group_item_id',
        'subject_id',
        'date',
        'time',
        'duration',
        'credit_hours',
        'max_marks',
        'min_marks'
    ];


    public function exam_group_item(){
        return $this->belongsTo(ExamGroupItem::class,'exam_group_item_id');
    }


    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    

}
