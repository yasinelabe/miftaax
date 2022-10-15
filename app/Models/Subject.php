<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "name",
        "code"
    ];

    public function exam_group_items(){
        return $this->belongsToMany(ExamGroupItem::class,'exam_subjects');
    }

    function exam_results(){
        return $this->hasMany(ExamResult::class,'subject_id');
    }
}