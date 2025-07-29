@extends('website.layout')

@section('title', 'Cart')

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

            <div class="cart-items m-3 p-4">
                <div class="title-cart my-3">
                    <h3>Cart ( {{ $cart->items_count }} )</h3>
                </div>
                <div class="d-flex">
                    <div class="mx-3 select-all-cart">
                        <input type="checkbox" class="me-3" id="checkboxall">
                        <label for="">Select All Items</label>
                    </div>
                    <div class="delete">
                        <button disabled onclick="deleteItemsFromCart()">Delete Selected Items</button>
                    </div>
                </div>
                <div>
                    <form action="{{ route('updateCart', $cart->id) }}" method="post">
                        @csrf
                        @forelse ($cart->items as $item)
                            <div class="cart-item" id="cart-item-{{ $item->id }}">
                                <div class="check-item">
                                    <input type="checkbox" name="itemsIds[]" value="{{ $item->id }}">
                                </div>
                                <div class="cart-title">
                                    <div class="image-item">
                                        <img src="{{ $item->product->img_path }}" alt="">
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
                                                <button type="button" class="btn"
                                                    onclick="incrementCounter(event,{{ $item->product_id }})"><i
                                                        class="fas fa-plus"></i></button>
                                                <input class="p-3 counter" name="item[{{ $item->id }}]"
                                                    id="counter-{{ $item->product_id }}" value="{{ $item->quantity }}">
                                                <button type="button" class="btn"
                                                    onclick="decrementCounter(event,{{ $item->product_id }})"><i
                                                        class="fas fa-minus"></i></button>
                                                @if (in_array($item->product_id, $productIdsInWishlist))
                                                    <i class="fas fa-heart wishList text-danger"
                                                        data-id="{{ $item->product_id }}"></i>
                                                @else
                                                    <i class="fas fa-heart wishList" data-id="{{ $item->product_id }}"></i>
                                                @endif
                                                <i class="fas fa-trash mx-2" onclick="deleteItemsFromCart(event)"
                                                    data-id="{{ $item->id }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center my-3">
                                <a href="{{ route('categories') }}" class="btn order-btn">Continuo Shopping</a>
                            </div>
                        @endforelse
                        @if (count($cart->items) > 0)
                            <div class="text-center">
                                <button class="btn order-btn">Update Cart</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="me-4 flex-grow-1">
            <div class="px-5">
                <h3>Order Summery</h3>
                <div class="summery">
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Items discount</p>
                        <p class="mb-1 discount w-25">-US ${{ $cart->discount }}</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Subtotal</p>
                        <p class="mb-1 w-25">US ${{ $cart->sub_total }}</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Shipping</p>
                        <p class="mb-1 w-25 shipping-city">US {{ $cart->shipping != 0 ? '$' . $cart->shipping : '$0' }}</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Estimated total</p>
                        <p class="mb-1 w-25">US ${{ $cart->estimated_total }}</p>
                    </div>
                </div>
                <div class="text-center my-3">
                    @if (count($cart->items) > 0)
                        <a href="{{ route('placeOrder') }}" class="btn order-btn">checkOut( {{ count($cart->items) }}
                            )</a>
                    @else
                        <a href="{{ route('categories') }}" class="btn order-btn">Continuo Shopping</a>
                    @endif

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
            let count = counter.value
            counter.value = parseInt(count) + 1
        }

        function decrementCounter(e, id) {
            let counter = document.querySelector('#counter-' + id);
            let count = counter.value
            if (count == 0) {
                return;
            }
            counter.value = parseInt(count) - 1
        }
    </script>

    <script>
        let itemsIds = [];
        let checkBoxItems = document.querySelectorAll('[name="itemsIds[]"]');
        document.querySelectorAll('[name="itemsIds[]"]').forEach(el => {

            el.onchange = () => {

                if (itemsIds.indexOf(el.value) != -1) {
                    itemsIds.splice(itemsIds.indexOf(el.value), 1);
                } else {
                    itemsIds.push(el.value);
                }

                if (itemsIds.length > 0) {
                    document.querySelector('.delete button').removeAttribute('disabled');
                }

                checkboxAll();
            }
        });

        function checkboxAll() {
            let checkBoxItems = document.querySelectorAll('[name="itemsIds[]"]');
            let lengthCheckedBoxAllItem = document.querySelectorAll('[name="itemsIds[]"]:checked').length
            console.log(lengthCheckedBoxAllItem);
            if (checkBoxItems.length == lengthCheckedBoxAllItem) {
                // alert(1)
                document.querySelector('#checkboxall').checked = true;
            } else {
                document.querySelector('#checkboxall').checked = false;
            }

        }
        document.querySelector('#checkboxall')?.addEventListener('click', () => {
            itemsIds = [];
            document.querySelectorAll('[name="itemsIds[]"]').forEach(el => {

                if (document.querySelector('#checkboxall').checked == true) {
                    document.querySelector('.delete button').removeAttribute('disabled');
                    el.checked = true
                    itemsIds.push(el.value);
                } else {
                    itemsIds = [];
                    el.checked = false
                }
            })

        })

        function deleteItemsFromCart(e) {
            if (e != null) {
                let parentElement = e.target;
                let id = parentElement.getAttribute('data-id');
                itemsIds.push(id);
            }

            $.ajax({
                method: 'POST',
                url: "{{ route('deleteItemsFromCart') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'itemsIds': itemsIds
                },
                success: function(res) {
                    if (res.status == 200) {
                        res.itemsIds.forEach(el => {
                            document.querySelector('#cart-item-' + el).remove();
                        })
                    }
                },
                error: function(err) {
                    if (err.status == 401) {
                        window.location.href = '{{ route('login') }}'
                    }
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("المتصفح لا يدعم تحديد الموقع.");
            }

            function showPosition(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                // let city;
                const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const city = data.address.city || data.address.town || data.address.village || data
                            .address.county;
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('cityDiscount') }}",
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'city': city
                            },
                            success: function(res) {
                                if (res.status == 200) {
                                    document.querySelector('.shipping-city').textContent = ' Us $' +
                                        res
                                        .price;
                                }
                            },

                        });

                    })
                    .catch(error => console.error(error));



            }


        });
    </script>
@endpush
