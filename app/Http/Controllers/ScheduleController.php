<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassRoom;
use App\Models\ClassRoomSubject;
use App\Models\SubjectGroup;
use App\Repositories\ClassRoomRepository;

class ScheduleController extends Controller
{

    public $classRoomRepository;

    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }


    public function index(Request $request)
    {
        $schedules = [];

        if ($request->getMethod() == 'POST') :
            if (isset($request->teacher_id)) :
                $schedules = Schedule::where(['teacher_id' => $request->teacher_id])->orderBy('time_in', 'ASC')->get();
            elseif (isset($request->class_room_id)) :
                $schedules = Schedule::where(['class_room_id' => $request->class_room_id])->orderBy('time_in', 'ASC')->get();
            endif;
        endif;

        $list = true;
        $class_rooms = $this->classRoomRepository->active_classes();
        $teachers = Teacher::all();
        return view('schedules.index', compact('schedules','teachers', 'list', 'class_rooms'));
    }
    public function create(Request $request)
    {
        $teacher_ids = Teacher::all();
        $subject_ids = Subject::all();
        $class_rooms = $this->classRoomRepository->active_classes();
        $subject_groups = SubjectGroup::all();
        $class_room_subjects = [];
        if ($request->getMethod() == "POST") :
            $class_room_subjects = ClassRoomSubject::where(['class_room_id' => $request->class_room_id, 'subject_group_id' => $request->subject_group_id])->get();
        endif;

        return view('schedules.create', compact('teacher_ids', 'subject_ids', 'class_rooms', 'subject_groups', 'class_room_subjects'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['class_room_id' => 'required']);
        $days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thrustday', 'friday'];
        $class_room_id = $request->class_room_id;
        foreach ($days as $day) :
            $subjects = $day . '_subjects';
            $teachers = $day . '_teacher_ids';
            $time_ins = $day . '_time_ins';
            $time_outs = $day . '_time_outs';
            $day_subjects = $request->$subjects;
            $day_teachers = $request->$teachers;
            $day_time_ins = $request->$time_ins;
            $day_time_outs = $request->$time_outs;

            if ($day_subjects != '') {
                foreach ($day_subjects as $k => $subject) :
                    $teacher = $day_teachers[$k];
                    $time_in = $day_time_ins[$k];
                    $time_out = $day_time_outs[$k];
                    $schedule = new Schedule();
                    $schedule->day = $day;
                    $schedule->teacher_id = $teacher;
                    $schedule->subject_id = $subject;
                    $schedule->time_in = $time_in;
                    $schedule->time_out = $time_out;
                    $schedule->class_room_id = $class_room_id;
                    $schedule->save();
                endforeach;
            }

        endforeach;
        session()->flash('message', 'Record created successfully.');
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
