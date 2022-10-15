<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'name'
    ];  



    public function exams(){
        return $this->hasMany(Exam::class,'exam_type_id');
    }
}
