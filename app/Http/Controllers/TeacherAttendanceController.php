<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherAttendance;
use App\Models\Teacher;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $teacher_attendances = TeacherAttendance::whereDate('created_at', Carbon::today())->get();
        $list = true;
        return view('teacher_attendances.index', compact('teacher_attendances', 'list'));
    }
    public function create()
    {
        $teacher_ids = Teacher::all();
        return view('teacher_attendances.create', compact('teacher_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['is_absent' => 'required', 'teacher_id' => 'required', 'time_in' => 'required']);
        $teacherattendance = new TeacherAttendance();
        $teacherattendance->fill($request->all());
        $teacherattendance->save();
        return redirect()->route('teacher_attendances.index');
    }
    public function show(TeacherAttendance $teacherattendance)
    {
        return view('teacher_attendances.show', compact('teacherattendance',));
    }
    public function edit(TeacherAttendance $teacherattendance)
    {
        $teacher_ids = Teacher::all();
        return view('teacher_attendances.edit', compact('teacherattendance', 'teacher_ids'));
    }
    public function update(Request $request, TeacherAttendance  $teacherattendance)
    {
        $this->validate($request, ['is_absent' => 'required', 'teacher_id' => 'required', 'time_in' => 'required', 'time_out' => 'required',]);
        $teacherattendance->is_absent = $request->is_absent;
        $teacherattendance->teacher_id = $request->teacher_id;
        $teacherattendance->time_in = $request->time_in;
        $teacherattendance->time_out = $request->time_out;
        $teacherattendance->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('teacher_attendances.edit', $teacherattendance->id);
    }
    public function destroy(TeacherAttendance $teacherattendance)
    {
        $teacherattendance->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('teacher_attendances.index');
    }
}
