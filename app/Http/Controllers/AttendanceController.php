<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceResult;
use App\Models\AttendanceResultStatus;
use App\Models\ClassRoom;
use App\Repositories\ClassRoomRepository;

class AttendanceController extends Controller
{

    protected $feeRepository;
    protected $classRoomRepository;


    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }

    public function index()
    {
        $attendances = Attendance::all();

        $list = true;
        return view('attendances.index', compact('attendances', 'list'));
    }
    
    public function create()
    {
        $class_room_ids = $this->classRoomRepository->active_classes();
        $statuses = AttendanceResultStatus::all();
        return view('attendances.create', compact('class_room_ids', 'statuses'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['attendance_date' => 'required', 'class_room_id' => 'required', 'students' => 'required']);
        $attendance = new Attendance();
        $attendance->class_room_id = $request->class_room_id;
        $attendance->attendance_date = $request->attendance_date;
        $attendance->save();

        foreach ($request->students as $k=>$student) :
            $status = 'statuses_'.$student;
            $attendanceresult = new AttendanceResult();
            $attendanceresult->attendance_id = $attendance->id;
            $attendanceresult->student_id = $student;
            $attendanceresult->attendance_result_status_id = $request->$status;
            $attendanceresult->save();
        endforeach;
        session()->flash('success', 'Record created successfully.');
        return redirect()->route('attendances.index');
    }
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance',));
    }
    public function edit(Attendance $attendance)
    {
        $class_room_ids = ClassRoom::all();
        return view('attendances.edit', compact('attendance', 'class_room_ids'));
    }
    public function update(Request $request, Attendance  $attendance)
    {
        $this->validate($request, ['attendance_date' => 'required', 'class_room_id' => 'required',]);
        $attendance->attendance_date = $request->attendance_date;
        $attendance->class_room_id = $request->class_room_id;
        $attendance->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('attendances.edit', $attendance->id);
    }
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('attendances.index');
    }


    
}
