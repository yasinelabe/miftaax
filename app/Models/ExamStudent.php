<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStudent extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'exam_students';

    public $fillable = [
        'exam_group_item_id',
        'student_id'
    ];


    public function exam_group_item(){
        return $this->belongsTo(ExamGroupItem::class,'exam_group_item_id');
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
