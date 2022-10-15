<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Student;
use App\Models\User;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::all();
        $users = User::all();
        $list = true;
        return view('leaves.index', compact('leaves','users','list'));
    }
    public function create()
    {
        $student_ids = Student::all();
        return view('leaves.create', compact('student_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['student_id' => 'required', 'apply_date' => 'required', 'from_date' => 'required', 'to_date' => 'required', 'reason' => 'required']);
        $leave = new Leave();
        $leave->fill($request->all());
        $leave->save();
        return redirect()->route('leaves.index');
    }
    public function show(Leave $leave)
    {
        return view('leaves.show', compact('leave',));
    }
    public function edit(Leave $leave)
    {
        $student_ids = Student::all();
        return view('leaves.edit', compact('leave', 'student_ids'));
    }
    public function update(Request $request, Leave  $leave)
    {
        $this->validate($request, ['student_id' => 'required', 'apply_date' => 'required', 'from_date' => 'required', 'to_date' => 'required', 'reason' => 'required']);
        $leave->student_id = $request->student_id;
        $leave->apply_date = $request->apply_date;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->reason = $request->reason;
        $leave->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('leaves.edit', $leave->id);
    }
    public function destroy(Leave $leave)
    {
        $leave->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('leaves.index');
    }
    public function approve(Leave $leave)
    {
        $leave->status = "approved";
        $leave->approved_by = auth()->user()->id;
        $leave->save();
        session()->flash('success', 'Approved Successfully');
        return redirect()->route('leaves.index');
    }
}
