<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\StudentClassRoom;

class StudentRepository
{

    public function active_students()
    {
        return Student::where('is_active', 1);
    }

    public function students_with_class_rooms()
    {
        $all_students = Student::all()->filter(function($student){
            $class_rooms = StudentClassRoom::where('student_id',$student->id);
            if($class_rooms->count() > 0){
                return $student;
            }
        });

        return $all_students;
    }

    public function students_without_class_rooms()
    {
        $all_students = Student::all()->filter(function($student){
            $class_rooms = StudentClassRoom::where('student_id',$student->id);
            if($class_rooms->count() == 0){
                return $student;
            }
        });

        return $all_students;
    }
}