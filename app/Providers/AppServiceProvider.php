<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        view()->composer('*', function ($view) {

            $adminPermissions = [];

            if (isset(auth()->guard('admin')->user()->id)) {
                if (auth()->guard('admin')->user()->id == 1) {
                    $adminPermissions = Permission::where('in_sidebar', 1)->orderBy('reorder_by', 'asc')->get();
                } else {
                    $rolePermissionsIDs = RolePermission::where('role_id', Auth::guard('admin')->user()->role_id)->pluck('permission_id')->toArray();
                    if (count($rolePermissionsIDs) > 0) {
                        // dd($rolePermissionsIDs);
                        $roleParentPermissionIDs = Permission::whereIn('id', $rolePermissionsIDs)->pluck('parent_id')->toArray();
                        $adminPermissions = Permission::whereIn('id', $roleParentPermissionIDs)->Where('in_sidebar', 1)->orderBy('reorder_by', 'asc')->get();
                        // dd($adminPermissions);
                    }
                }
            }
            $view->with([
                'adminPermissions' => $adminPermissions
            ]);
        });
        // view()->share('adminPermissions', $adminPermissions);

        Paginator::useBootstrapFive();
    }
}
