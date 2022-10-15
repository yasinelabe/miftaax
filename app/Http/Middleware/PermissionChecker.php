<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if user is not admin, we need to check if user has permission to access the route by checking role_permission table
        if (auth()->user()->role_id != 1) {
            $route_name = $request->route()->getName();
            $role_permissions = $request->session()->get('role_permissions');
            $has_permission = false;

            // split route name . e.g. users.index
            $route_name_parts = explode('.', $route_name);
            $asset_name = $route_name_parts[0];



            foreach ($role_permissions as $role_permission) {
                if ($role_permission->asset->route_name == $route_name) {
                    $has_permission = true;
                }

                if ($route_name == $asset_name . '.create') {
                    // check if role has permission to create
                    if ($role_permission->operation->operation_name == 'create' && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }
                if ($route_name == $asset_name . '.store') {
                    // check if role has permission to store
                    if ($role_permission->operation->operation_name == 'create' && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }

                if ($route_name == $asset_name . '.update') {
                    // check if role has permission to update
                    if ($role_permission->operation->operation_name == 'update'  && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }

                if ($route_name == $asset_name . '.edit') {
                    // check if role has permission to edit
                    if ($role_permission->operation->operation_name == 'update'  && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }

                if ($route_name == $asset_name . '.delete') {
                    // check if role has permission to destroy
                    if ($role_permission->operation->operation_name == 'delete'  && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }
                if ($route_name == $asset_name . '.show') {
                    // check if role has permission to show
                    if ($role_permission->operation->operation_name == 'read'  && $role_permission->asset->assets_name == $asset_name) {
                        $has_permission = true;
                    }
                }
            }

            if (!$has_permission) {
                return redirect()->route('not_authorized');
            }

            return $next($request);
        }

        return $next($request);
    }
}
