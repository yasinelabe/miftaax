<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'name',
        'room_number',
        'number_of_students',
        'status',
        'hostel_room_type_id',
        'hostel_id'
    ];

    function hostel(){
        return $this->belongsTo(Hostel::class,'hostel_id');
    }

    function hostelroomtype(){
        return $this->belongsTo(HostelRoomType::class,'hostel_room_type_id');
    }

}
