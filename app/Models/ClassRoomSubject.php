<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomSubject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'class_room_id',
        'subject_group_id'
    ];


    public function class_room(){
        return $this->belongsTo(ClassRoom::class);
    }
    public function subject_group(){
        return $this->belongsTo(SubjectGroup::class,'subject_group_id');
    }
}