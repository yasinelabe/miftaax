<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectGroupItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'subject_group_id',
        'subject_id'
    ];


    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function subject_group(){
        return $this->belongsTo(SubjectGroup::class,'subject_group_id');
    }
}
