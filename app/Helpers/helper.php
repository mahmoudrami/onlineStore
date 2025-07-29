<?php

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

function uploadImage($image, $folder = '')
{
    $imageName = rand() . time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images/' . $folder), $imageName);
    return $imageName;
}

function deleteImage($imageName, $folder = '')
{
    file::delete(public_path('images/' . $folder . '/' . $imageName));
    return true;
}


function has_permission($route_name)
{
    if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->id == 1) {
        return true;
    }
    $checkPermission = Permission::where('route_name', $route_name)->first();
    // return $checkPermission->id;
    if (!$checkPermission) {
        return false;
    }
    // return $checkPermission;

    $rolePermissionsIds = RolePermission::where('role_id', Auth::guard('admin')->user()->role_id)->pluck('permission_id')->toArray();
    $roleParentPermissionsIds = Permission::whereIn('id', $rolePermissionsIds)->pluck('parent_id')->toArray();

    if (in_array($checkPermission->id, $roleParentPermissionsIds)) {
        return true;
    }

    if (in_array($checkPermission->id, $rolePermissionsIds)) {
        return true;
    }

    return false;
}