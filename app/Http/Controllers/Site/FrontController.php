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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeSupplierMail;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Bank;
use App\Models\Money;
use App\Models\ProductAttributeValue;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Shipping;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Stichoza\GoogleTranslate\GoogleTranslate;



class FrontController extends Controller
{

    function index()
    {
        $services = Service::take(4)->get();
        return view('website.index', compact('services'));
    }

    function categories()
    {
        $categories = Category::active()->get();
        $products = Product::active()->where('quantity', '>', 0)->paginate(10);
        return view('website.categories', compact('categories', 'products'));
    }

    function category(Request $request, $id)
    {
        $item = Category::findOrFail($id);
        $category_id = $id;
        $productsCategory = $item->products();

        $finalProductAfterSearch = collect();

        $attributes = Attribute::get()->pluck('name')->toArray();

        foreach ($attributes as $attribute) {
            if ($request->query($attribute)) {
                $attributeValueIds = AttributeValue::whereTranslation('value', $request->query($attribute))
                    ->pluck('id')->toArray();
                $productsIds = ProductAttributeValue::whereIn('attribute_value_id', $attributeValueIds)
                    ->pluck('product_id')->toArray();
                $products = Product::where('category_id', $id)->whereIn('id', $productsIds)->get();
                $finalProductAfterSearch = $finalProductAfterSearch->merge($products);
            }
        }

        if ($request->query()) {
            $productsCategory = $finalProductAfterSearch->unique('id')->values();
        } else {
            $productsCategory = $item->products()->active()->get();
        }
        $categories = Category::active()->get();
        $attributes = Attribute::active()->get();

        return view('website.category', compact('item', 'productsCategory', 'categories', 'attributes', 'category_id'));
    }

    function product(Product $product)
    {
        $services = Service::inRandomOrder()->take(3)->get();
        return view('website.product', compact('product', 'services'));
    }

    function cart()
    {
        $cart = Cart::withCount('items')->firstOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [
                'user_id' => Auth::user()->id,
            ]
        );
        return view('website.cart', compact('cart'));
    }

    function cityDiscount(Request $request)
    {

        // dd(1);
        $cities = Shipping::pluck('city')->toArray();

        $closestCity = null;
        $highestSimilarity = 0;

        foreach ($cities as $city) {
            similar_text(strtolower($request->city), strtolower($city), $percent);

            if ($percent > $highestSimilarity) {
                $highestSimilarity = $percent;
                $closestCity = $city;
            }
        }

        $shipping = Shipping::where('city', "LIKE", "%$closestCity%")->first();

        Session::put('shippingPrice', $shipping->price);

        return response()->json([
            'status' => 200,
            'price' => $shipping->price
        ]);
    }

    function addToItemCart($id)
    {
        $product = Product::findOrFail($id);

        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'You must be logged in to add item to cart'
            ]);
        }

        try {
            DB::beginTransaction();
            $cart = Cart::firstOrCreate(
                [
                    'user_id' => Auth::user()->id,
                ],
                [
                    'user_id' => Auth::user()->id,
                ]
            );

            $productInCart = $cart->items()->where('product_id', $id)->first();

            if ($product->quantity > 0) {
                if (!$productInCart) {
                    $cart->items()->create(
                        [
                            'cart_id' => $cart->id,
                            'product_id' => $id,
                            'price' => $product->price,
                            'quantity' => 1,
                        ]
                    );
                } else {
                    $quantity = $productInCart->quantity + 1;
                    $cart->items()->where('product_id', $id)->update([
                        'quantity' => $quantity,
                        'price' => $product->price * $quantity
                    ]);
                }
            } else {
                return response()->json([
                    'data' => 'Product Not Available',
                    'status' => 200
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => 'Item Add Successfully',
            'status' => 201
        ]);
    }

    // this is using in website
    function addItemToCart(Request $request, $id)
    {
        $user = Auth::guard('web')->user();

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

    function deleteItemsFromCart(Request $request)
    {
        // dd($request->itemsIds);
        $request->validate([
            'itemsIds' => 'required|array',
            'itemsIds.*' => 'exists:cart_items,id',
        ]);


        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->first();
        $cart->items()->whereIn('id', $request->itemsIds)->delete();

        return response()->json([
            'status' => 200,
            'itemsIds' => $request->itemsIds,
            'data' => 'items Selected Deleted Successfully',
        ]);
    }

    function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $itemIdsInCart = $cart->items()->pluck('id')->toArray();
        foreach ($itemIdsInCart as $itemId) {;
            $cart->items()->where('id', $itemId)->update([
                'quantity' => $request->item[$itemId]
            ]);
        }

        $cart->update([
            'amount' => $cart->amount
        ]);
        return redirect()->back()->with('success', 'Updated Cart Successfully');
    }

    // function order()
    // {
    //     try {
    //         DB::beginTransaction();
    //         $cart = Cart::where('user_id', Auth::guard('admin')->user()->id)->first();
    //         $order = Order::create([
    //             'user_id' =>  $cart->user_id,
    //             'total_price' =>  $cart->price,
    //         ]);
    //         foreach ($cart->items as $item) {
    //             $order->items()->create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $item->product_id,
    //                 'quantity' => $item->quantity,
    //                 'price' => $item->price,
    //             ]);
    //         }
    //         DB::commit();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         throw new Exception($e->getMessage());
    //     }
    //     return response()->json([
    //         'status' => 200,
    //         'msg' => 'Created Order Successfully',
    //     ]);
    // }

    function review(Request $request, $id)
    {

        $request->validate([
            'rating' => 'required|digits_between:1,5',
            'comment' => 'required',
        ]);

        $review = Review::create([
            'user_id' => Auth::guard('web')->user()->id,
            'product_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $review->save();


        return redirect()->back()->with('success', 'Review Successfully');
    }

    function loginUserShow()
    {
        $services = Service::take(4)->get();
        return view('website.login', compact('services'));
    }

    function registerUserShow()
    {
        $services = Service::take(4)->get();
        return view('website.register', compact('services'));
    }

    function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users,email',
            'email' => 'email|required|unique:suppliers,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($request->type === 'user') {
            $user = User::create($data);
            Auth::guard('web')->login($user);

            return redirect()->route('homePage');
        } else {
            $supplier = Supplier::create($data);
            $user = Auth::guard('supplier')->login($supplier);

            Mail::to($request->email)->send(new WelcomeSupplierMail($data));

            return redirect()->route('supplier.homePage');
        }
    }
    function loginUser(Request $request)
    {

        if (! Auth::attempt($request->only('email', 'password'))) {
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
        $productsIDs = Wishlist::where('user_id', Auth::guard('web')->user()->id)->get()->pluck('product_id')->toArray();
        $productsWishlist = Product::whereIn('id', $productsIDs)->get();

        $products = Product::paginate(10);

        $productCategories = $productsWishlist->first()?->category->products()->paginate(10);

        return view('website.wishlist', compact('products', 'productCategories', 'productsWishlist'));
    }

    function ItemToWishlist($id)
    {

        $productInWishList = Wishlist::where('product_id', $id)->first();
        if ($productInWishList) {
            $productInWishList->delete();

            return response()->json([
                'data' => 'Product Deleted Wishlist Successfully',
                'status' => 200
            ]);
        } else {
            Wishlist::create([
                'product_id' => $id,
                'user_id' =>  Auth::user()->id
            ]);

            return response()->json([
                'data' => 'Product Add Wishlist Successfully',
                'status' => 201
            ]);
        }
    }

    function profile()
    {
        $user = Auth::user();
        return view('website.profile', compact('user'));
    }

    function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id() . ',id',
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
        $user->email = $request->email;
        $user->location = $request->location;
        $user->bio = $request->bio;

        if ($request->hasFile('image')) {
            deleteImage($user->image, 'users');
            $user->image = uploadImage($request->file('image'), 'users');
        }

        $user->save();

        return redirect()->back()->with('success', 'Updated Profile Successfully');
    }

    function editPassword(Request $request)
    {
        return view('website.editPassword');
    }

    function editPasswordStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed'
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user = $request->user();
            $user->password = $request->new_password;
            $user->save();
            return redirect()->back()->with('success', 'Password Updated');
        }

        return redirect()->back()->with('error', 'Password Not Updated');
    }

    public function checkPassword(Request $request)
    {
        return Hash::check($request->old_password, Auth::user()->password);
    }


    function deleteAccount(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->delete();
        $user->save();
        Auth::logout();

        return redirect()->route('homePage');
    }

    function placeOrder()
    {
        return view('website.placeOrder');
    }


    function savePlaceOrder(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'national' => 'required',
        ]);
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->first();


        $data = $request->except('_token');

        Session::put('placeOrder', $data);

        return redirect()->route('checkout-payment', $cart->id);
    }


    // translate when user click to button translate on product page

    public function translateText(Request $request)
    {
        $text = $request->input('text');
        $target = $request->input('lang', 'ar');

        $tr = new GoogleTranslate($target);
        $translated = $tr->translate($text);

        return response()->json(['translatedText' => $translated]);
    }


    function showForgotPassword()
    {
        // $services = Service::take(4)->get();
        return view('website.forgotPassword');
    }

    function showResetPassword()
    {
        $services = Service::take(4)->get();
        return view('website.resetPassword', compact('services'));
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        // dd(1);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $code = rand(100000, 999999);  // كود مكون من 6 أرقام
        $user->reset_code = $code;
        $user->reset_code_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::raw("Your reset code is: $code", function ($message) use ($user) {
            $message->to($user->email)->subject('Reset Password Code');
        });

        // return response()->json(['message' => 'Code sent to your email']);
        session(['email' => $request->email]);
        return redirect()->route('resetPassword');
    }

    public function verifyCode(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->reset_code != $request->code || now()->gt($user->reset_code_expires_at)) {
            return response()->json(['message' => 'Invalid or expired code'], 400);
        }

        return response()->json(['message' => 'Code verified']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
            'new_password' => 'required|string|min:6',
        ]);
        // dd($request->all());

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->reset_code != $request->code || now()->gt($user->reset_code_expires_at)) {
            return response()->json(['message' => 'Invalid or expired code'], 400);
        }

        $user->password = $request->new_password;
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        return redirect()->route('login');
    }
}