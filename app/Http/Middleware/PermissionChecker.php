<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use function Psy\debug;

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
            $feature_permissions = $request->session()->get('feature_permissions');
            $has_permission = false;

            foreach ($feature_permissions as $feature_permission) {
                $routes = explode(',',$feature_permission->feature->route_name);
                foreach($routes as $route){
                    if($route == $route_name){
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
