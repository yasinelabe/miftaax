<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\FeaturePermission;
use App\Models\Operation;
use App\Models\Role;

class FeaturePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_permission');
    }


    public function index(Role $role)
    {
       // Get all features
        $features = Feature::all();

        // Get all operations
        $operations = Operation::all();

        return view('feature_permissions.index', compact('features', 'operations',  'role'));
    }
    public function store(Request $request)
    {
        $features = $request->input('features');
        $role = Role::find($request->input('role_id'));

        // Delete all permissions for this role
        FeaturePermission::where('role_id', $role->id)->delete();

        foreach ($features as $feature) {
            $feature_operations = 'feature_'.$feature . '_operations';
            $operations = $request->$feature_operations;

            if (!empty($operations)) {
                foreach ($operations as $operation) {
                    $role_feature = new FeaturePermission();
                    $role_feature->role_id = $role->id;
                    $role_feature->feature_id = $feature;
                    $role_feature->operation_id = $operation;
                    $role_feature->save();
                }
            }
        }
  

        // session message
        session()->flash('success', 'Role permissions updated successfully');
        return redirect()->route('feature_permissions.index', $role->id);
    }
}
