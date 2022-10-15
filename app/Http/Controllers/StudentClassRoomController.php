<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClassRoom;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Repositories\ClassRoomRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Validator;

class StudentClassRoomController extends Controller
{

    protected $studentRepository;
    protected $classRoomRepository;


    public function __construct(StudentRepository $studentRepository, ClassRoomRepository $classRoomRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->classRoomRepository = $classRoomRepository;
    }

    public function index()
    {
        $student_class_rooms = StudentClassRoom::all();
        $list = true;
        return view('student_class_rooms.index', compact('student_class_rooms', 'list'));
    }
    public function create()
    {
        $student_ids = $this->studentRepository->students_without_class_rooms();
        $class_room_ids = $this->classRoomRepository->active_classes();
        return view('student_class_rooms.create', compact('student_ids', 'class_room_ids'));
    }
    public function store(Request $request)
    {
        if (isset($_GET['batch'])) :
            $this->validate($request, ['students' => 'required', 'class_room_id' => 'required',]);
            $Validator = Validator::make($request->all(), [
                'class_room_id' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $classroom = ClassRoom::find($value);
                        foreach ($classroom->students as $student) {
                            foreach ($request->students as $st) {
                                if ($student->id == $st) {
                                    $fail('Some Students already exists in the class');
                                }
                            }
                        }
                    },
                ],
            ]);

            if ($Validator->fails()) {
                return redirect()->route('student_class_rooms.admit_in_batches')
                    ->withErrors($Validator)
                    ->withInput();
            }

            foreach ($request->students as $st) {
                $studentclassroom = new StudentClassRoom();
                $studentclassroom->class_room_id = $request->class_room_id;
                $studentclassroom->student_id = $st;
                $studentclassroom->save();
            }

        else :
            $this->validate($request, ['student_id' => 'required', 'class_room_id' => 'required',]);
            $Validator = Validator::make($request->all(), [
                'class_room_id' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $classroom = ClassRoom::find($value);
                        foreach ($classroom->students as $student) {
                            if ($student->id == $request->student_id) {
                                $fail('Student already exists in the class');
                            }
                        }
                    },
                ],
            ]);

            if ($Validator->fails()) {
                return redirect()->route('student_class_rooms.create')
                    ->withErrors($Validator)
                    ->withInput();
            }

            $studentclassroom = new StudentClassRoom();
            $studentclassroom->fill($request->all());
            $studentclassroom->save();
        endif;
        session()->flash('success', 'Record Saved successfully.');
        return redirect()->route('student_class_rooms.index');
    }
    public function show(StudentClassRoom $studentclassroom)
    {
        return view('student_class_rooms.show', compact(' studentclassroom',));
    }
    public function edit(StudentClassRoom $studentclassroom)
    {
        $student_ids = $this->studentRepository->students_with_class_rooms();
        $class_room_ids = $this->classRoomRepository->active_classes();
        return view('student_class_rooms.edit', compact('studentclassroom', 'student_ids', 'class_room_ids'));
    }
    public function update(Request $request, StudentClassRoom  $studentclassroom)
    {
        $this->validate($request, ['student_id' => 'required', 'class_room_id' => 'required',]);
        $studentclassroom->student_id = $request->student_id;
        $studentclassroom->class_room_id = $request->class_room_id;
        $studentclassroom->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('student_class_rooms.edit', $studentclassroom->id);
    }
    public function destroy(StudentClassRoom $studentclassroom)
    {
        $studentclassroom->delete();
        return redirect()->route('student_class_rooms.index');
        session()->flash('success', 'Deleted Successfully');
    }


    public function admit_in_batches()
    {
        $student_ids = $this->studentRepository->students_without_class_rooms();
        $class_room_ids = $this->classRoomRepository->active_classes();
        return view('student_class_rooms.batch', compact('student_ids', 'class_room_ids'));
    }
}