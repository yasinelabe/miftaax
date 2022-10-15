<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'name',
        'class_room_id'
    ];


    function class_room(){
        return $this->belongsTo(ClassRoom::class);
    }
}
