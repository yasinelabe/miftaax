<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rack;

class RackController extends Controller
{
    public function index()
    {
        $racks = Rack::all();
        $list = true;
        return view('racks.index', compact('racks', 'list'));
    }
    public function create()
    {
        return view('racks.create',);
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'total_rows' => 'required', 'total_columns' => 'required', ]);
        $rack = new Rack();
        $rack->fill($request->all());
        $rack->save();
        return redirect()->route('racks.index');
    }
    public function show(Rack $rack)
    {
        return view('racks.show', compact('rack',));
    }
    public function edit(Rack $rack)
    {
        return view('racks.edit', compact('rack'));
    }
    public function update(Request $request, Rack  $rack)
    {
        $this->validate($request, ['name' => 'required', 'total_rows' => 'required', 'total_columns' => 'required']);
        $rack->name = $request->name;
        $rack->total_rows = $request->total_rows;
        $rack->total_columns = $request->total_columns;
        $rack->save();
        session()->flash('message', 'Record updated successfully.');
        return redirect()->route('racks.edit', $rack->id);
    }
    public function destroy(Rack $rack)
    {
        $rack->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('racks.index');
    }
}
