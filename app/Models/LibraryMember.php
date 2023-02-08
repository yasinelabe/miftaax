<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'library_member_type_id',
        'member_id'
    ];


    function library_member_type()
    {
        return $this->belongsTo(LibraryMemberType::class, 'library_member_type_id');
    }


    function member()
    {
        switch ($this->library_member_type->id) {
            case 1:
                # code...
                return $this->belongsTo(Student::class,'member_id');
                break;

            case 2:
                return $this->belongsTo(Teacher::class,'member_id');
                break;

            default:
                # code...

                break;
        }
    }
}
