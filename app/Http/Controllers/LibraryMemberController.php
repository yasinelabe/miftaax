<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibraryMember;
use App\Models\LibraryMemberType;
use App\Models\Student;
use App\Models\Teacher;

class LibraryMemberController extends Controller
{
    public function index()
    {
        $library_members = LibraryMember::all();
        $list = true;
        return view('library_members.index', compact('library_members', 'list'));
    }
    public function create()
    {
        $library_member_type_ids = LibraryMemberType::all();
        $students = Student::all();
        $teachers = Teacher::all();
        return view('library_members.create', compact('library_member_type_ids','students','teachers'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['library_member_type_id' => 'required', 'member_id' => 'required',]);
        $librarymember = new LibraryMember();
        $librarymember->fill($request->all());
        $librarymember->save();
        return redirect()->route('library_members.index');
    }
    public function show(LibraryMember $librarymember)
    {
        return view('library_members.show', compact('librarymember',));
    }
    public function edit(LibraryMember $librarymember)
    {
        $library_member_type_ids = LibraryMemberType::all();
        $member_ids = LibraryMember::all();
        return view('library_members.edit', compact('librarymember', 'library_member_type_ids', 'member_ids'));
    }
    public function update(Request $request, LibraryMember  $librarymember)
    {
        $this->validate($request, ['library_member_type_id' => 'required', 'member_id' => 'required',]);
        $librarymember->library_member_type_id = $request->library_member_type_id;
        $librarymember->member_id = $request->member_id;
        $librarymember->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('library_members.edit', $librarymember->id);
    }
    public function destroy(LibraryMember $librarymember)
    {
        $librarymember->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('library_members.index');
    }

    
}
