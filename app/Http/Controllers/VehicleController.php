<?php namespace App\Http\Controllers; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\Vehicle; class VehicleController extends Controller { public function index() { $vehicles = Vehicle::all(); $list = true;return view('vehicles.index', compact('vehicles', 'list')); } public function create() { return view('vehicles.create',); } public function store(Request $request) { $this->validate($request, [ 'plate_number' => 'required', 'vehicle_model' => 'required', 'year_made' => 'required', 'registration_number' => 'required', 'chasis_number' => 'required', 'max_seating_capacity' => 'required', 'driver_name' => 'required', 'driver_licence' => 'required', 'driver_contact' => 'required', 'image' => 'required', 'note' => 'required', ]); $vehicle = new Vehicle(); $vehicle->fill($request->all()); $vehicle->save(); return redirect()->route('vehicles.index'); } public function show(Vehicle $vehicle) { return view('vehicles.show', compact('vehicle',)); } public function edit(Vehicle $vehicle) { return view('vehicles.edit', compact('vehicle')); } public function update(Request $request, Vehicle  $vehicle) { $this->validate($request, [ 'plate_number' => 'required', 'vehicle_model' => 'required', 'year_made' => 'required', 'registration_number' => 'required', 'chasis_number' => 'required', 'max_seating_capacity' => 'required', 'driver_name' => 'required', 'driver_licence' => 'required', 'driver_contact' => 'required', 'image' => 'required', 'note' => 'required', ]); $vehicle->plate_number = $request->plate_number; $vehicle->vehicle_model = $request->vehicle_model; $vehicle->year_made = $request->year_made; $vehicle->registration_number = $request->registration_number; $vehicle->chasis_number = $request->chasis_number; $vehicle->max_seating_capacity = $request->max_seating_capacity; $vehicle->driver_name = $request->driver_name; $vehicle->driver_licence = $request->driver_licence; $vehicle->driver_contact = $request->driver_contact; $vehicle->image = $request->image; $vehicle->note = $request->note; $vehicle->save(); session()->flash('message', 'Record updated successfully.'); return redirect()->route('vehicles.edit' , $vehicle->id); } public function destroy(Vehicle $vehicle) { $vehicle->delete(); session()->flash('success', 'Deleted Successfully'); return redirect()->route('vehicles.index'); } } ?>