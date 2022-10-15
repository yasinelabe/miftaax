<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
            // regenerate session ID
            $request->session()->regenerate();
            /**
             * role id 1 = admin
             * if user has role id not 1, we need fetch role_permission table and store it in session
             */
            if (auth()->user()->role_id != 1) {
                $role_permissions = RolePermission::where('role_id', auth()->user()->role_id)->get();
                $request->session()->put('role_permissions', $role_permissions);
            }

            $active_academic_year = AcademicYear::where('is_active', 1)->get();
            if($active_academic_year->count() == 1){
                $request->session()->put('ActiveYear', $active_academic_year[0]->id);
            }
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        auth()->logout();
        // clear session
        session()->flush();
        return redirect()->route('login');
    }
}
