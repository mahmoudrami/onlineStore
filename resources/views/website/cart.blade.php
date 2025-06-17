@extends('website.layout')

@section('content')
    <div class="breadcrumb">
        <ul>
            <li class="active">cart</li>
            <li>Order</li>
            <li>Pay</li>
            <li>Order Complete</li>
        </ul>
    </div>
    <div class="d-flex gap-5">
        <div style="width: 800px;">
            <div class="d-flex mx-3 p-3" style="background-color: #fcf0ed">
                <div class="px-3">
                    <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px" alt="">
                </div>
                <div>
                    <h4>Shipping Free !</h4>
                    <p> Buy AU$157.06 more to enjoy Free Standard Shipping!</p>
                </div>
            </div>

            <div class="cart m-3 p-4">
                <div class="title-cart my-3">
                    <h3>Cart ({{ count($cart->items) }})</h3>
                </div>
                <div class="d-flex">
                    <div class="mx-3 select-all-cart">
                        <input type="checkbox" class="me-3">
                        <label for="">Select All Items</label>
                    </div>
                    <div class="delete">
                        <p>Delete Selected Items</p>
                    </div>
                </div>
                <div>
                    @foreach ($cart->items as $item)
                        <div class="cart-item">
                            <div class="check-item">
                                <input type="checkbox" name="" id="">
                            </div>
                            <div class="cart-title">
                                <div class="image-item">
                                    <img src="{{ asset('website/images/dress.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="cart-body flex-grow-1">
                                <div class="title-item">
                                    <h5 class="mb-5"> {{ $item->product->name }}</h5>
                                </div>
                                <div class="content-item">
                                    <div>
                                        <h4 class="mb-5">AU${{ $item->price }}</h4>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="shipping">Shipping: US
                                            $4.04</p>
                                        <div>
                                            <button class="btn" onclick="incrementCounter(event,1)"><i
                                                    class="fas fa-plus"></i></button>
                                            <span class="p-3" id="counter-1">1</span>
                                            <button class="btn" onclick="decrementCounter(event,1)"><i
                                                    class="fas fa-minus"></i></button>
                                            <i class="fas fa-heart mx-2"></i>
                                            <i class="fas fa-trash mx-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="me-4 flex-grow-1">
            <div class="px-5">
                <h3>Order Summery</h3>
                <div class="summery">
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Items discount</p>
                        <p class="mb-1 discount">-US $1.54</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Subtotal</p>
                        <p class="mb-1">-US $1.54</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Shipping</p>
                        <p class="mb-1">-US $1.54</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Estimated total</p>
                        <p class="mb-1">-US $1.54</p>
                    </div>
                </div>
                <div class="text-center my-3">
                    <button class="btn"
                        style="background-color: var(--mainColor);color: white;padding: 15px 50px;font-weight: 700">checkOut
                        (
                        3 )</button>
                </div>
            </div>
            <div class="p-5">
                <h3>Pay With</h3>
                <div class="d-flex gap-3">
                    <img src="{{ asset('website/images/paypal.png') }}" width="70" alt="">
                    <img src="{{ asset('website/images/pay.png') }}" width="70" alt="">
                    <img src="{{ asset('website/images/visa.png') }}" width="70" alt="">
                    <img src="{{ asset('website/images/apple-pay.png') }}" width="70" alt="">
                </div>
                <hr>
                <div>
                    <h3>
                        Buyer Protection
                    </h3>
                    <p style="font-size: 20px;font-weight: 500"><img src="{{ asset('website/images/security.png') }}"
                            style="margin-right:10px" width="30px" alt="">
                        Get a full
                        refund if the item is not as
                        described or not delivered</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function incrementCounter(e, id) {
            let counter = document.querySelector('#counter-' + id);
            let count = counter.innerHTML
            counter.innerHTML = parseInt(count) + 1
        }

        function decrementCounter(e, id) {
            let counter = document.querySelector('#counter-' + id);
            let count = counter.innerHTML
            if (count == 0) {
                return;
            }
            counter.innerHTML = parseInt(count) - 1
        }
    </script>
@endpush
