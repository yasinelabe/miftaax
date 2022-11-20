<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }

    public function index()
    {
        // Get all users
        $users = User::all();
        $list = true;
        return view('users.index', compact('users', 'list'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'name' => 'required|max:255',
            'role_id' => 'required',
        ]);

        // Create a new user
        $user = new User();
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->save();

        // Redirect to the users page with a success message
        session()->flash('success', 'User created successfully');
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'username' => [
                'required',
                'max:255',
                'unique:users,username,' . $user->id,
            ],
            'name' => 'required|max:255',
        ]);

        // Update the user
        $user->username = $request->username;
        $user->name = $request->name;
        $user->save();

        // Redirect to the users page with a success message
        session()->flash('success', 'User updated successfully');
        return redirect()->route('users.edit', $user->id);
    }


    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect to the users page with a success message
        session()->flash('success', 'User deleted successfully');
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function change_password()
    {
        return view('users.change_password');
    }

    function update_password(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
