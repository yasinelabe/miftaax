<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceResultStatus;

class AttendanceResultStatusController extends Controller
{
    public function index()
    {
        $attendance_result_statuses = AttendanceResultStatus::all();
        $list = true;
        return view('attendance_result_statuses.index', compact('attendance_result_statuses', 'list'));
    }
    public function create()
    {
        return view('attendance_result_statuses.create',);
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',]);
        $attendanceresultstatus = new AttendanceResultStatus();
        $attendanceresultstatus->fill($request->all());
        $attendanceresultstatus->save();
        return redirect()->route('attendance_result_statuses.index');
    }
    public function show(AttendanceResultStatus $attendanceresultstatus)
    {
        return view('attendance_result_statuses.show', compact('attendanceresultstatus',));
    }
    public function edit(AttendanceResultStatus $attendanceresultstatus)
    {
        return view('attendance_result_statuses.edit', compact('attendanceresultstatus'));
    }
    public function update(Request $request, AttendanceResultStatus  $attendanceresultstatus)
    {
        $this->validate($request, ['name' => 'required',]);
        $attendanceresultstatus->name = $request->name;
        $attendanceresultstatus->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('attendance_result_statuses.edit', $attendanceresultstatus->id);
    }
    public function destroy(AttendanceResultStatus $attendanceresultstatus)
    {
        $attendanceresultstatus->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('attendance_result_statuses.index');
    }
}
