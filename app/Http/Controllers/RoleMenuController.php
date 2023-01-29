<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Operation;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;

class RoleMenuController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }

    public function index(Role $role)
    {
        // Get all menus
        $menus = Menu::all();

        // Get all operations
        $operations = Operation::all();

        return view('role_menus.index', compact('menus', 'operations',  'role'));
    }

    public function store(Request $request)
    {
        $menus = $request->input('menus');
        $sub_menus = $request->input('sub_menus');
        $low_menus = $request->input('low_menus');
        $role = Role::find($request->input('role_id'));

        // Delete all permissions for this role
        RoleMenu::where('role_id', $role->id)->delete();

        foreach ($menus as $menu) {
            $menu_operations = 'menu_'.$menu . '_operations';
            $operations = $request->$menu_operations;

            if (!empty($operations)) {
                foreach ($operations as $operation) {
                    $role_menu = new RoleMenu();
                    $role_menu->role_id = $role->id;
                    $role_menu->menu_id = $menu;
                    $role_menu->operation_id = $operation;
                    $role_menu->save();
                }
            }
        }
        foreach ($sub_menus as $sub_menu) {
            $sub_menu_operations = 'sub_menu_'.$sub_menu . '_operations';
            $operations = $request->$sub_menu_operations;

            if (!empty($operations)) {
                foreach ($operations as $operation) {
                    $role_menu = new RoleMenu();
                    $role_menu->role_id = $role->id;
                    $role_menu->sub_menu_id = $sub_menu;
                    $role_menu->operation_id = $operation;
                    $role_menu->save();
                }
            }
        }
        foreach ($low_menus as $low_menu) {
            $low_menu_operations = 'low_menu_'.$low_menu . '_operations';
            $operations = $request->$low_menu_operations;

            if (!empty($operations)) {
                foreach ($operations as $operation) {
                    $role_menu = new RoleMenu();
                    $role_menu->role_id = $role->id;
                    $role_menu->low_menu_id = $low_menu;
                    $role_menu->operation_id = $operation;
                    $role_menu->save();
                }
            }
        }

        // session message
        session()->flash('success', 'Role permissions updated successfully');
        return redirect()->route('role_menus.index', $role->id);
    }
}
