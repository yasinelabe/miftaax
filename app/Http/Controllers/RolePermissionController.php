<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Operation;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }

    public function index(Role $role)
    {
        // Get all assets
        $assets = Asset::all();

        // Get all operations
        $operations = Operation::all();

        return view('role_permissions.index', compact('assets', 'operations',  'role'));
    }

    public function store(Request $request)
    {
        $assets = $request->input('assets');
        $role = Role::find($request->input('role_id'));

        // Delete all permissions for this role
        RolePermission::where('role_id', $role->id)->delete();

        foreach ($assets as $asset) {
            $asset_operations = $asset . '_operations';
            $operations = $request->$asset_operations;

            if (!empty($operations)) {
                foreach ($operations as $operation) {
                    $role_permission = new RolePermission();
                    $role_permission->role_id = $role->id;
                    $role_permission->asset_id = $asset;
                    $role_permission->operation_id = $operation;
                    $role_permission->save();
                }
            }
        }

        // session message
        session()->flash('success', 'Role permissions updated successfully');
        return redirect()->route('role_permissions.index', $role->id);
    }
}
