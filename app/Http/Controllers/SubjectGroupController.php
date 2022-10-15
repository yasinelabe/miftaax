<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubjectGroup;

class SubjectGroupController extends Controller
{
    public function index()
    {
        $subject_groups = SubjectGroup::all();
        $list = true;
        return view('subject_groups.index', compact('subject_groups', 'list'));
    }
    public function create()
    {
        return view('subject_groups.create',);
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required',]);
        $subjectgroup = new SubjectGroup();
        $subjectgroup->fill($request->all());
        $subjectgroup->save();
        return redirect()->route('subject_groups.index');
    }
    public function show(SubjectGroup $subjectgroup)
    {
        return view('subject_groups.show', compact(' subjectgroup',));
    }
    public function edit(SubjectGroup $subjectgroup)
    {
        return view('subject_groups.edit', compact('subjectgroup'));
    }
    public function update(Request $request, SubjectGroup  $subjectgroup)
    {
        $this->validate($request, ['name' => 'required',]);
        $subjectgroup->name = $request->name;
        $subjectgroup->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('subject_groups.edit', $subjectgroup->id);
    }
    public function destroy(SubjectGroup $subjectgroup)
    {
        $subjectgroup->delete();
        return redirect()->route('subject_groups.index');
        session()->flash('success', 'Deleted Successfully');
    }
}
