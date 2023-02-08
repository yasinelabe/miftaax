<?php namespace App\Http\Controllers; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\HostelRoomType; class HostelRoomTypeController extends Controller { public function index() { $hostel_room_types = HostelRoomType::all(); $list = true;return view('hostel_room_types.index', compact('hostel_room_types', 'list')); } public function create() { return view('hostel_room_types.create',); } public function store(Request $request) { $this->validate($request, [ 'name' => 'required', ]); $hostelroomtype = new HostelRoomType(); $hostelroomtype->fill($request->all()); $hostelroomtype->save(); return redirect()->route('hostel_room_types.index'); } public function show(HostelRoomType $hostelroomtype) { return view('hostel_room_types.show', compact('hostelroomtype',)); } public function edit(HostelRoomType $hostelroomtype) { return view('hostel_room_types.edit', compact('hostelroomtype')); } public function update(Request $request, HostelRoomType  $hostelroomtype) { $this->validate($request, [ 'name' => 'required', ]); $hostelroomtype->name = $request->name; $hostelroomtype->save(); session()->flash('message', 'Record updated successfully.'); return redirect()->route('hostel_room_types.edit' , $hostelroomtype->id); } public function destroy(HostelRoomType $hostelroomtype) { $hostelroomtype->delete(); session()->flash('success', 'Deleted Successfully'); return redirect()->route('hostel_room_types.index'); } } ?>