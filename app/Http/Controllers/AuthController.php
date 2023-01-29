<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\FeaturePermission;
use App\Models\Menu;
use App\Models\RoleMenu;
use App\Models\SubMenu;
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
                $role_menus = RoleMenu::where('role_id', auth()->user()->role_id)->get();
                $feature_permissions = FeaturePermission::where('role_id', auth()->user()->role_id)->get();
                $role_menus->map(function($permission){
                    if($permission->menu_id != null){
                        $permission->menu_id = Menu::find($permission->menu_id);
                    }
                    if($permission->sub_menu_id != null){
                        $permission->sub_menu_id = SubMenu::find($permission->sub_menu_id);
                    }
                    if($permission->low_menu_id != null){
                        $permission->low_menu_id = Menu::find($permission->low_menu_id);
                    }
                    return $permission;
                });
                $request->session()->put('role_menus', $role_menus);
                $request->session()->put('feature_permissions', $feature_permissions);
            }

            $active_academic_year = AcademicYear::where('is_active', 1)->get();
            if ($active_academic_year->count() == 1) {
                $request->session()->put('ActiveYear', $active_academic_year[0]->id);
            }

            // fetch menus
            $main_menu = Menu::all();
            $request->session()->put('main_menu', $main_menu);
            return redirect()->route('dashboard');
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
