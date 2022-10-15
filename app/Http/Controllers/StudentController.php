<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\BloodGroup;
use App\Models\StudentAddress;
use App\Models\StudentFeeTransaction;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $list = true;
        return view('students.index', compact('students', 'list'));
    }
    public function create()
    {
        $guardian_ids = Guardian::all();
        $blood_group_ids = BloodGroup::all();
        $student_addresses = StudentAddress::all();
        return view('students.create', compact('guardian_ids', 'blood_group_ids','student_addresses'));
    }

    public function import(Request $request)
    {
        $this->validate($request, ['file' => 'required']);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());
        Excel::import(new StudentImport, 'uploads/' . $filename);
        unlink('uploads/' . $filename);
        session()->flash('success', 'Content imported successfully');
        return redirect()->route('students.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['fullname' => 'required', 'gender' => 'required', 'guardian_id' => 'required', 'date_of_birth' => 'required', 'joined_date' => 'required', 'student_address_id' => 'required', 'blood_group_id' => 'required', 'has_medical_emergency' => 'required', 'is_active' => 'required', 'is_graduated' => 'required', 'fee_amount' => 'required', 'fee_balance' => 'required',]);
        $student = new Student();
        $student->fill($request->all());
        $student->save();
        return redirect()->route('students.index');
    }

    public function profile(Student $student)
    {
        return view('students.profile', compact('student',));
    }

    public function edit(Student $student)
    {
        $guardian_ids = Guardian::all();
        $blood_group_ids = BloodGroup::all();
        return view('students.edit', compact('student', 'guardian_ids', 'blood_group_ids'));
    }

    public function update(Request $request, Student  $student)
    {
        $this->validate($request, ['fullname' => 'required', 'gender' => 'required', 'guardian_id' => 'required', 'date_of_birth' => 'required', 'joined_date' => 'required', 'student_address_id' => 'required', 'blood_group_id' => 'required', 'has_medical_emergency' => 'required', 'is_active' => 'required', 'is_graduated' => 'required', 'fee_amount' => 'required', 'fee_balance' => 'required',]);
        $student->fullname = $request->fullname;
        $student->gender = $request->gender;
        $student->guardian_id = $request->guardian_id;
        $student->date_of_birth = $request->date_of_birth;
        $student->joined_date = $request->joined_date;
        $student->address = $request->address;
        $student->blood_group_id = $request->blood_group_id;
        $student->has_medical_emergency = $request->has_medical_emergency;
        $student->is_active = $request->is_active;
        $student->is_graduated = $request->is_graduated;
        $student->fee_amount = $request->fee_amount;
        $student->fee_balance = $request->fee_balance;
        $student->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('students.edit', $student->id);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('students.index');
    }
}
