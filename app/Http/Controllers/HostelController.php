<?php namespace App\Http\Controllers; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\Hostel; class HostelController extends Controller { public function index() { $hostels = Hostel::all(); $list = true;return view('hostels.index', compact('hostels', 'list')); } public function create() { return view('hostels.create',); } public function store(Request $request) { $this->validate($request, [ 'name' => 'required', ]); $hostel = new Hostel(); $hostel->fill($request->all()); $hostel->save(); return redirect()->route('hostels.index'); } public function show(Hostel $hostel) { return view('hostels.show', compact('hostel',)); } public function edit(Hostel $hostel) { return view('hostels.edit', compact('hostel')); } public function update(Request $request, Hostel  $hostel) { $this->validate($request, [ 'name' => 'required', ]); $hostel->name = $request->name; $hostel->save(); session()->flash('message', 'Record updated successfully.'); return redirect()->route('hostels.edit' , $hostel->id); } public function destroy(Hostel $hostel) { $hostel->delete(); session()->flash('success', 'Deleted Successfully'); return redirect()->route('hostels.index'); } } ?>