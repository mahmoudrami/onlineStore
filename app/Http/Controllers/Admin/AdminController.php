<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::where('id', '>', 1)->latest('id')->paginate(10);
        return view('admins.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::active()->select('id', 'name')->get();
        return view('admins.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;

        if ($request->hasFile('image')) {
            $admin->image = uploadImage($request->file('image'), 'users');
        }

        $admin->save();

        flash()->success('Admin Created Successfully');
        return redirect()->route('admin.admin.index');
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
    public function edit(Admin $admin)
    {
        $roles = Role::active()->select('id', 'name')->get();
        return view('admins.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('image')) {
            $admin->image = uploadImage($request->file('image'), 'users');
        }

        $admin->save();

        flash()->success('Admin Updated Successfully');
        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        flash()->success('Admin Deleted Successfully');
        return redirect()->route('admin.admin.index');
    }
}
