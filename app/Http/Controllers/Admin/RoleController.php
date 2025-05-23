<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RolePermission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10); // Paginate the roles
        return view('admins.roles.index', compact('roles')); // Pass the roles to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::where('parent_id', null)->OrWhere('parent_id', 0)->get();

        return view('admins.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);


        $role = new Role();
        $role->name = $request->name;
        $role->save();

        foreach ($request->permissions as $permission) {
            $item = new RolePermission();
            $item->role_id = $role->id;
            $item->permission_id = $permission;
            $item->save();
        }

        flash()->success('Role Created Successfully');
        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissionsIDs = $role->role_permission()->pluck('permission_id')->toArray();
        $permissions = Permission::where('parent_id', null)->orWhere('parent_id', 0)->get();
        return view('admins.roles.edit', compact('role', 'permissionsIDs', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name
        ]);
        if (count($role->role_permission()->pluck('id')->toArray()) > 0) {
            foreach ($role->role_permission as $oldPermission) {
                $oldPermission->delete();
            }
        }
        if (isset($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $item = new RolePermission();
                $item->role_id = $role->id;
                $item->permission_id = $permission;
                $item->save();
            }
        }

        flash()->success('Role Updated Successfully');
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        flash()->success('Role Deleted Successfully');
        return redirect()->route('admin.role.index');
    }
}
