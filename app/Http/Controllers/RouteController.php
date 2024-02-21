<?php namespace App\Http\Controllers; use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\Route; class RouteController extends Controller { public function index() { $routes = Route::all(); $list = true;return view('routes.index', compact('routes', 'list')); } public function create() { return view('routes.create',); } public function store(Request $request) { $this->validate($request, [ 'name' => 'required', ]); $route = new Route(); $route->fill($request->all()); $route->save(); return redirect()->route('routes.index'); } public function show(Route $route) { return view('routes.show', compact('route',)); } public function edit(Route $route) { return view('routes.edit', compact('route')); } public function update(Request $request, Route  $route) { $this->validate($request, [ 'name' => 'required', ]); $route->name = $request->name; $route->save(); session()->flash('message', 'Record updated successfully.'); return redirect()->route('routes.edit' , $route->id); } public function destroy(Route $route) { $route->delete(); session()->flash('success', 'Deleted Successfully'); return redirect()->route('routes.index'); } } ?>