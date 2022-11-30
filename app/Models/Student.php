<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'fullname',
        'gender',
        'guardian_id',
        'date_of_birth',
        'joined_date',       
        'student_address_id',
        'blood_group_id',
        'has_medical_emergency',
        'is_active',
        'is_graduated',
        'fee_amount',
        'fee_balance',
    ];


    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function blood_group()
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }

    public function class_rooms(){
        return $this->belongsToMany(ClassRoom::class,'student_class_rooms');
    }


    public function fee_transactions(){
        return $this->hasMany(StudentFeeTransaction::class,'student_id');
    }

    public function exam_results(){
        return $this->hasMany(ExamResult::class,'student_id');
    }

    public function exam_group_items(){
        return $this->belongsToMany(ExamGroupItem::class,'exam_students');
    }

    public function student_address(){
        return $this->belongsTo(StudentAddress::class,'student_address_id');
    }

    public function attendance_results(){
        return $this->hasMany(AttendanceResult::class,'student_id');
    }

    public function hasClassRoom($class_room_id){
        foreach($this->class_rooms as $class_room){
            if($class_room->id == $class_room_id){
                return true;
            }
           
        }

        return false;
    }


    

}
