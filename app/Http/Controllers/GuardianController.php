<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guardian;

class GuardianController extends Controller
{
    public function index()
    {
        $guardians = Guardian::all();
        $list = true;
        return view('guardians.index', compact('guardians', 'list'));
    }
    public function create()
    {
        if(isset($_GET['iframe'])):
            $iframe=true;
        else:
            $iframe=false;
        endif;
        return view('guardians.create',compact('iframe'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['fullname' => 'required', 'tell' => 'required', 'family_link' => 'required',]);
        $guardian = new Guardian();
        $guardian->fill($request->all());
        $guardian->save();
        return redirect()->route('guardians.create');
    }
    public function show(Guardian $guardian)
    {
        return view('guardians.show', compact(' guardian',));
    }
    public function edit(Guardian $guardian)
    {
        return view('guardians.edit', compact('guardian'));
    }
    public function update(Request $request, Guardian  $guardian)
    {
        $this->validate($request, ['fullname' => 'required', 'tell' => 'required', 'family_link' => 'required',]);
        $guardian->fullname = $request->fullname;
        $guardian->tell = $request->tell;
        $guardian->family_link = $request->family_link;
        $guardian->save();
        session()->flash('success', 'Record updated successfully.');
        return redirect()->route('guardians.edit', $guardian->id);
    }
    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return redirect()->route('guardians.index');
        session()->flash('success', 'Deleted Successfully');
    }
}
