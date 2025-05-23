<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Notifications\ChangeProductStatusNotification;

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
}
