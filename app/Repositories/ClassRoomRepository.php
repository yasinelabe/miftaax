<?php

namespace App\Repositories;

use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\StudentClassRoom;
use Illuminate\Support\Facades\Validator;

class ClassRoomRepository
{

    public function active_classes()
    {
        return ClassRoom::whereHas('academic_year', function ($query) {
            $query->where('is_active', 1);
        })->get();
    }

    public function save_class_room($data)
    {
        $classroom = new ClassRoom();
        $classroom->name = $data->name . '-' . AcademicYear::find($data->academic_year_id)->year;
        $classroom->academic_year_id = $data->academic_year_id;
        $classroom->shift_id = $data->shift_id;
        return $classroom->save();
    }

    public function  import_students($data)
    {
        foreach ($data->students as $student) {
            $Validator = $this->check_if_student_exists($student, $data->class_room);
            if ($Validator->fails()) {
                return redirect()->route('class_rooms.index')
                    ->withErrors($Validator)
                    ->withInput();
            }
            $studentClassRoom = new StudentClassRoom();
            $studentClassRoom->class_room_id = $data->class_room;
            $studentClassRoom->student_id = $student;
            $studentClassRoom->save();
        }
    }

    function check_if_student_exists($student, $classroom)
    {
        return Validator::make(['student' => $student, 'class_room' => $classroom], [
            'class_room' => [
                'required',
                function ($attribute, $value, $fail) use ($student) {
                    $classroom = ClassRoom::find($value);
                    foreach ($classroom->students as $s) {
                        if ($s->id == $student) {
                            $fail('Student already exists in the class');
                        }
                    }
                },
            ],
        ]);
    }
}
