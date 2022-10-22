<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassRoom;
use App\Models\SubjectGroup;
use App\Repositories\ClassRoomRepository;

class ScheduleController extends Controller
{

    public $classRoomRepository;

    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
        
    }


    public function index()
    {
        $schedules = Schedule::all();
        $list = true;
        return view('schedules.index', compact('schedules', 'list'));
    }
    public function create()
    {
        $teacher_ids = Teacher::all();
        $subject_ids = Subject::all();
        $class_rooms= $this->classRoomRepository->active_classes();
        $subject_groups = SubjectGroup::all();
        return view('schedules.create', compact('teacher_ids', 'subject_ids', 'class_rooms','subject_groups'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['teacher_id' => 'required', 'subject_id' => 'required', 'class_room_id' => 'required', 'day' => 'required', 'time_in' => 'required', 'time_out' => 'required',]);
        $schedule = new Schedule();
        $schedule->fill($request->all());
        $schedule->save();
        return redirect()->route('schedules.index');
    }
    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule',));
    }
    public function edit(Schedule $schedule)
    {
        $teacher_ids = Teacher::all();
        $subject_ids = Subject::all();
        $class_room_ids = ClassRoom::all();
        return view('schedules.edit', compact('schedule', 'teacher_ids', 'subject_ids', 'class_room_ids'));
    }
    public function update(Request $request, Schedule  $schedule)
    {
        $this->validate($request, ['teacher_id' => 'required', 'subject_id' => 'required', 'class_room_id' => 'required', 'day' => 'required', 'time_in' => 'required', 'time_out' => 'required',]);
        $schedule->teacher_id = $request->teacher_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->class_room_id = $request->class_room_id;
        $schedule->day = $request->day;
        $schedule->time_in = $request->time_in;
        $schedule->time_out = $request->time_out;
        $schedule->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('schedules.edit', $schedule->id);
    }
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('schedules.index');
    }
}
