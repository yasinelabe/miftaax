<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroup extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable = [
        'name',
        'description',
        "exam_type_id"
    ];


    public function exam_type()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function exam_group_items(){
        return $this->hasMany(ExamGroupItem::class);
    }





}