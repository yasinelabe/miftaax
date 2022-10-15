<?php namespace App\Http\Controllers; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\Subject; class SubjectController extends Controller { public function index() { $subjects = Subject::all(); $list = true;return view('subjects.index', compact('subjects', 'list')); } public function create() { return view('subjects.create',); } public function store(Request $request) { $this->validate($request, [ 'name' => 'required', 'code' => 'required', ]); $subject = new Subject(); $subject->fill($request->all()); $subject->save(); return redirect()->route('subjects.index'); } public function show(Subject $subject) { return view('subjects.show', compact(' subject',)); } public function edit(Subject $subject) { return view('subjects.edit', compact('subject')); } public function update(Request $request, Subject  $subject) { $this->validate($request, [ 'name' => 'required', 'code' => 'required', ]); $subject->name = $request->name; $subject->code = $request->code; $subject->save(); session()->flash('success', 'Record updated successfully.'); return redirect()->route('subjects.edit' , $subject->id); } public function destroy(Subject $subject) { $subject->delete(); return redirect()->route('subjects.index'); session()->flash('success', 'Deleted Successfully'); } } ?>