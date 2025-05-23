<?php

namespace App\Http\Controllers\Site;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Language;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class FrontController extends Controller
{

    function index()
    {

        $categories = Category::active()->get();
        $products = Product::active()->get();
        return view('website.test', compact('categories', 'products'));
    }

    function categories()
    {
        return view('website.categories');
    }

    function category()
    {
        // $category = Category::findOrFail($id);

        // $productsCategory = $category->products;

        return view('website.category');
        dd($productsCategory);
    }

    function products()
    {
        $products = Product::where('quantity', '>', 0)->paginate(12);
    }

    function product()
    {
        return view('website.product');
    }

    function addItemToCart(Request $request, $id)
    {
        $user = Auth::guard('admin')->user();

        try {
            DB::beginTransaction();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);


            $item = $cart->items()->where('product_id', $id)->first();

            if ($item) {

                $item->quantity += $request->quantity;
                $item->save();
            } else {
                $product = Product::FindOrFail($id);
                $cart->items()->create([
                    'product_id' => $id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'status' => 200,
            'msg' => 'Add Item To Cart Successfully',
        ]);
    }

    function order()
    {
        try {
            DB::beginTransaction();
            $cart = Cart::where('user_id', Auth::guard('admin')->user()->id)->first();
            $order = Order::create([
                'user_id' =>  $cart->user_id,
                'total_price' =>  $cart->price,
            ]);
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        return response()->json([
            'status' => 200,
            'msg' => 'Created Order Successfully',
        ]);
    }

    function payment($id)
    {
        // change status current order from user using function update
        $order = Order::FindOrFail($id);
        $order->update([
            'status' => 'paid'
        ]);
        // sent notification from user
        $admin = Admin::find(1);
        $user = User::findOrFail(1);
        $admin->notify(new OrderStatusUpdatedNotification($order));
        $user->notify(new OrderStatusUpdatedNotification($order));

        dd(2);
    }

    function addItemToWishlist($id)
    {
        Wishlist::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'product_id' => $id

        ]);

        return response()->json([
            'status' => 200,
            'msg' => 'Product Add Successfully'
        ]);
    }

    function review(Request $request, $id)
    {

        $review = Review::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'product_id' => $id,
            'rating' => $request->rating,
        ]);

        $locales = Language::active()->get()->pluck('id')->toArray();
        foreach ($locales as $locale) {
            $review->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $review->save();


        return response()->json([
            'status' => 200,
            'msg' => 'Product Add Successfully'
        ]);
    }

    function contactUs(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'message' => 'required',
        ]);
        // ContactUs::create([
        //     'email' => $request->email,
        //     'message' => $request->message,
        // ]);
    }

    function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        if ($request->type === 'user') {
            $user = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            Auth::guard('web')->login($user);

            return redirect()->route('homePage');
        } else {
            $supplier = Supplier::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            Auth::guard('supplier')->login($supplier);
            return redirect()->route('supplier.homePage');
        }
    }
    function loginUser(Request $request)
    {

        if (! Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::hit($request->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        return redirect()->intended(route('homePage', absolute: false));
    }

    function userOrder()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('website.userOrder', compact('orders'));
    }

    function userWishlist()
    {
        // $productsIDs = Wishlist::where('user_id', Auth::user()->id)->get()->pluck('id')->toArray();
        // $products = Product::whereIn('product_id', $productsIDs)->get();

        // return view('website.wishlist', compact('products'));
        return view('website.wishlist');
    }

    function profile()
    {
        // $user = Auth::user();
        // return view('website.profile', compact('user'));
        return view('website.profile');
    }

    function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // $user = $request->user();
        if (Auth::guard('supplier')->check()) {
            /** @var Supplier $user*/
            $user = Auth::guard('supplier')->user();
        } else {
            /** @var User $user*/
            $user = Auth::guard('web')->user();
        }

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->location = $request->location;
        $user->bio = $request->bio;

        if ($request->hasFile('image')) {
            deleteImage($user->image, 'users');
            uploadImage($request->file('image'), 'users');
        }

        $user->save();

        return redirect()->route('profile.edit')->with('msg', 'Updated Profile Successfully');
    }

    function editPassword(Request $request)
    {
        return view('website.editPassword');
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            $user = $request->user();
            $user->password = $request->password;
            $user->save();
        }

        return response()->json([
            'msg' => 'password updated successfully',
            'status' => 200
        ]);
    }

    function test(Request $request)
    {
        // return 2;
        // return Auth::guard('admin')->user();
        // dd(Auth::guard('web')->user());


        // set key settings key in cache and 60 ix the time died in cache

        // Artisan::call('cache:clear');
        // Cache::remember('settings', 60, function () {
        //     return 'mahmoud test';
        // });

        // Session::put('mahmoud', 'rami'); // set key mahmoud in session and rami is value

        // return cache('settings');
        return session::get('mahmoud');
    }
}
