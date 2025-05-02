<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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

            return $request->action;
        }

        return false;

        return view('admins.index', compact('items')); // return view to the admin dashboard
    }
}
