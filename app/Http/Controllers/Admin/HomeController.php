<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Notifications\ChangeProductStatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    function index()
    {

        return view('admins.index');
    }

    public function changeStatus(Request $request, $model)
    {
        $role = 'App\\Models\\' . $model;

        // $items = $role::whereIn('id', $request->itemsIds)->get();
        if ($role != "") {
            if ($request->action == 'delete') {
                $role::query()->whereIn('id', $request->itemsIds)->delete();
            } else {
                if ($request->action) {
                    $role::query()->whereIn('id', $request->itemsIds)->update(['status' => $request->action]);
                }
            }

            if ($model == 'product') {
                $products = Product::whereIn('id', $request->itemsIds)->get();
                foreach ($products as $product) {
                    $product->supplier->notify(new ChangeProductStatusNotification($product));
                }
            }
            return $request->action;
        }

        return false;

        return view('admins.index', compact('items')); // return view to the admin dashboard
    }

    function edit()
    {
        // dd(1);
        $admin = Auth::guard('admin')->user();
        // return 3;
        return view('admins.edit', compact('admin'));
    }

    function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'old_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);
        /** @var User $admin */
        $admin = Auth::guard('admin')->user();

        $data = [
            'name' => $request->name,
        ];


        if ($request->has('password')) {
            $data['password'] = $request->password;
        }

        $admin->update($data);

        if ($request->hasFile('image')) {
            if ($admin->image) {
                $admin->image()->delete();
                file::delete(public_path('images/' . $admin->image->path));
            }
            $img_name = rand() . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $img_name);
            $admin->image()->create([
                'path' => $img_name,
            ]);
        }


        return redirect()->back()->with('msg', 'Updated Successflly');
    }
    public function checkPassword(Request $request)
    {
        // return dd($request->all());
        return Hash::check($request->password, Auth::guard('admin')->user()->password);
    }
}