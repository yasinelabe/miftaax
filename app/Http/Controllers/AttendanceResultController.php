<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceResult;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\AttendanceResultStatus;
use App\Repositories\ClassRoomRepository;
use Carbon\Carbon;

class AttendanceResultController extends Controller
{

    protected $classRoomRepository;


    public function __construct(ClassRoomRepository $classRoomRepository)
    {
        $this->classRoomRepository = $classRoomRepository;
    }

    public function index(Request $request)
    {
        $attendance_results = [];
        $list = true;
        $active_classes = $this->classRoomRepository->active_classes();

        if ($request->getMethod() == "POST") :
            $class_room = $request->class_room_id;
            $attendance_date = $request->attendance_date;
            
            $attendance = Attendance::where(['attendance_date'=>$attendance_date,'class_room_id'=>$class_room])->get();

            if($attendance->count() > 0){
                $attendance_results = Attendance::find($attendance[0]->id)->attendance_results;
            }
        endif;
        return view('attendance_results.index', compact('attendance_results', 'active_classes', 'list'));
    }

    public function create()
    {
        $attendance_ids = Attendance::all();
        $student_ids = Student::all();
        $attendance_result_status_ids = AttendanceResultStatus::all();
        return view('attendance_results.create', compact('attendance_ids', 'student_ids', 'attendance_result_status_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['attendance_id' => 'required', 'student_id' => 'required', 'attendance_result_status_id' => 'required']);
        $attendanceresult = new AttendanceResult();
        $attendanceresult->fill($request->all());
        $attendanceresult->save();
        return redirect()->route('attendance_results.index');
    }
    public function show(AttendanceResult $attendanceresult)
    {
        return view('attendance_results.show', compact('attendanceresult',));
    }
    public function edit(AttendanceResult $attendanceresult)
    {
        $attendance_ids = Attendance::all();
        $student_ids = Student::all();
        $attendance_result_status_ids = AttendanceResultStatus::all();
        return view('attendance_results.edit', compact('attendanceresult', 'attendance_ids', 'student_ids', 'attendance_result_status_ids'));
    }
    public function update(Request $request, AttendanceResult  $attendanceresult)
    {
        $this->validate($request, ['attendance_id' => 'required', 'student_id' => 'required', 'attendance_result_status_id' => 'required']);
        $attendanceresult->attendance_id = $request->attendance_id;
        $attendanceresult->student_id = $request->student_id;
        $attendanceresult->attendance_result_status_id = $request->attendance_result_status_id;
        $attendanceresult->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('attendance_results.edit', $attendanceresult->id);
    }
    public function destroy(AttendanceResult $attendanceresult)
    {
        $attendanceresult->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('attendance_results.index');
    }
}
