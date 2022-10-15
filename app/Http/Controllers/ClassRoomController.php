<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use App\Models\Shift;
use App\Models\StudentClassRoom;
use App\Repositories\ClassRoomRepository;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{

    protected $classRoomRepository;


    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }

    public function index()
    {
        $class_rooms = $this->classRoomRepository->active_classes();
        $academic_years = AcademicYear::all();
        $list = true;
        return view('class_rooms.index', compact('class_rooms', 'list', 'academic_years'));
    }

    public function create()
    {
        $academic_year_ids = AcademicYear::all();
        $shift_ids = Shift::all();
        return view('class_rooms.create', compact('academic_year_ids', 'shift_ids'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'academic_year_id' => 'required', 'shift_id' => 'required',]);
        $this->classRoomRepository->save_class_room($request);
        session()->flash('success', 'Record created successfully.');
        return redirect()->route('class_rooms.index');
    }

    public function show(ClassRoom $classroom)
    {
        return view('class_rooms.show', compact(' $classroom',));
    }
    public function edit(ClassRoom $classroom)
    {
        $academic_year_ids = AcademicYear::all();
        $shift_ids = Shift::all();
        return view('class_rooms.edit', compact('classroom', 'academic_year_ids', 'shift_ids'));
    }
    public function update(Request $request, ClassRoom  $classroom)
    {
        $this->validate($request, ['name' => 'required', 'academic_year_id' => 'required', 'shift_id' => 'required',]);
        $classroom->name = $request->name;
        $classroom->academic_year_id = $request->academic_year_id;
        $classroom->shift_id = $request->shift_id;
        $classroom->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('class_rooms.edit', $classroom->id);
    }
    public function destroy(ClassRoom $classroom)
    {
        $classroom->delete();
        return redirect()->route('class_rooms.index');
        session()->flash('success', 'Deleted Successfully');
    }

    function import_students(Request $request)
    {
        $this->validate($request, ['students' => 'required', 'academic_year' => 'required', 'class_room' => 'required',]);
        $this->classRoomRepository->import_students($request);
        session()->flash('success', 'Students imported successfully.');
        return redirect()->route('class_rooms.index');
    }

    public function get_class_students(ClassRoom $classroom)
    {
        $students = $classroom->students;

        foreach($students as $k=>$student):
            $student->exam_groups = $student->exam_group_items;
            $student->exam_results = $student->exam_results;
            $students[$k] = $student;
        endforeach;

        return response()->json(
            $students
        )->header('Content-type','Application/json');
    }
}
