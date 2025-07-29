<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\StripeClient;

class PaymentController extends Controller
{

    function create(Cart $cart)
    {
        if (count($cart->items) == 0) {
            return redirect()->route('shop');
        }
        return view('website.checkout', compact('cart'));
    }

    function store(Request $request)
    {

        $stripe = new StripeClient(config('services.stripe.secret_key'));

        $cart = Cart::findOrFail($request->cart_id);
        $amount = explode('.', $cart->estimated_total)[0];
        try {
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => 'mahmoud rami aqel',
                'receipt_email' =>  'momo.2003mo2@gmail.com',
                'metadata' => [
                    'cart_id' => $cart->id,
                    'name user' => 'farash mahmoud',
                    'custom_note' => 'شراء من التطبيق X',
                ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                ]
            ]);
            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        } catch (Error $e) {
            return Response::json([
                'error' => $e->getMessage()
            ]);
        }
    }

    function success(Request $request)
    {
        $stripe = new StripeClient(config('services.stripe.secret_key'));

        $paymentIntentId = $request->payment_intent;

        $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

        $chargeId = $paymentIntent->latest_charge;

        $charge = $stripe->charges->retrieve($chargeId);



        if ($paymentIntent->status !== 'succeeded') {
            return response()->json(['error' => 'Payment not completed.'], 400);
        }

        try {
            $cartId = $paymentIntent['metadata']['cart_id'];
            $cart = Cart::findOrFail($cartId);

            $cartItems = $cart->items;
            DB::beginTransaction();
            $order = Order::create([
                'user_id' => $cart->user_id,
                'total_price' => $cart->amount,
                'status' => 'paid'
            ]);


            $order->items()->createMany(
                $cartItems->map(function ($item) use ($order) {
                    return [
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'product_id' => $item->product_id
                    ];
                })->toArray()
            );


            if (Session::has('placeOrder')) {
                $data = Session::get('placeOrder');
                $placeOrder = $order->placeOrder()->create($data);
                Session::pull('placeOrder');
                $order->update([
                    'place_order_id' => $placeOrder->id
                ]);
            }

            $orderItems = $order->items();

            foreach ($orderItems as $orderItem) {
                $product = Product::findOrFail($orderItem->product_id);
                $product->quantity -= $orderItem->quantity;
                $product->save();
            }


            $cart->items()->delete();
            $cart->delete();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


        return redirect()->route('homePage');
    }

    function cancel(Request $request)
    {
        return $request->all();
    }
}
