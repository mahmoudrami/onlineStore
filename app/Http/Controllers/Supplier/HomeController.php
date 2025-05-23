<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index()
    {
        $monthlySales = DB::table('orders')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as orders_count, SUM(total_price) as total_sales')
            ->where('status', 'completed')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
        return view('suppliers.index');
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
