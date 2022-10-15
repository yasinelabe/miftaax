<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubjectGroupItem;
use App\Models\Subject;
use App\Models\SubjectGroup;

class SubjectGroupItemController extends Controller
{
    public function index()
    {
        $subject_group_items = SubjectGroupItem::all();
        $list = true;
        return view('subject_group_items.index', compact('subject_group_items', 'list'));
    }
    public function create()
    {
        $subject_ids = Subject::all();
        $subject_group_ids = SubjectGroup::all();
        return view('subject_group_items.create', compact('subject_ids', 'subject_group_ids'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['subject_id' => 'required', 'subject_group_id' => 'required',]);
        $subjectgroupitem = new SubjectGroupItem();
        $subjectgroupitem->fill($request->all());
        $subjectgroupitem->save();
        return redirect()->route('subject_groups.index');
    }
    public function show(SubjectGroupItem $subjectgroupitem)
    {
        return view('subject_group_items.show', compact(' subjectgroupitem',));
    }
    public function edit(SubjectGroupItem $subjectgroupitem)
    {
        $subject_ids = Subject::all();
        $subject_group_ids = SubjectGroup::all();
        return view('subject_group_items.edit', compact('subjectgroupitem', 'subject_ids', 'subject_group_ids'));
    }
    public function update(Request $request, SubjectGroupItem  $subjectgroupitem)
    {
        $this->validate($request, ['subject_id' => 'required', 'subject_group_id' => 'required',]);
        $subjectgroupitem->subject_id = $request->subject_id;
        $subjectgroupitem->subject_group_id = $request->subject_group_id;
        $subjectgroupitem->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('subject_group_items.edit', $subjectgroupitem->id);
    }
    public function destroy(SubjectGroupItem $subjectgroupitem)
    {
        $subjectgroupitem->delete();
        return redirect()->route('subject_group_items.index');
        session()->flash('success', 'Deleted Successfully');
    }
}
