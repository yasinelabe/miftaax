<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }

    public function index()
    {
        // Get all roles
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'role_name' => 'required|unique:roles|max:255',
        ]);

        // Create a new role
        $role = new Role();
        $role->role_name = $request->role_name;
        $role->save();

        // Redirect to the roles page
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        // Validate the request
        $request->validate([
            'role_name' => 'required|unique:roles|max:255',
        ]);

        // Update the role
        $role->role_name = $request->role_name;
        $role->save();

        // Redirect to the roles page
        session()->flash('success', 'Role updated successfully');
        return redirect()->route('roles.edit', $role->id);
    }

    public function destroy(Role $role)
    {
        // Delete the role
        $role->delete();

        // Redirect to the roles page
        session()->flash('success', 'Role deleted successfully');
        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }


}