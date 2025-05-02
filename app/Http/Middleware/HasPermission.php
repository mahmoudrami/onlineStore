<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('admin')->user()->status == 'not_active') {
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }


        $route_name = Route::currentRouteName();
        if (auth()->guard('admin')->user()->id == 1) {
            return $next($request);
        }

        if ($route_name == 'homePage') {
            return $next($request);
        }


        $checkPermission = Permission::where('route_name', $route_name)->first();

        if (!$checkPermission) {
            return $next($request);
        }





        if (isset(auth()->guard('admin')->user()->role_id)) {
            $rolePermissionsIDs = RolePermission::where('role_id', auth()->guard('admin')->user()->role_id)->pluck('permission_id')->toArray();
            $roleParentsPermissionsIDs = Permission::whereIn('id', $rolePermissionsIDs)->pluck('parent_id')->toArray();
        }


        if (in_array($checkPermission->id, $rolePermissionsIDs)) {
            return $next($request);
        }


        if (in_array($checkPermission->id, $roleParentsPermissionsIDs)) {
            return $next($request);
        }



        return redirect()->route('admin.index');
    }
}
