@extends('website.layout')

@section('title', 'Place Order')

@section('content')
    <div class="breadcrumb">
        <ul>
            <li>cart</li>
            <li class="active">Place Order</li>
            <li>Pay</li>
            <li>Order Complete</li>
        </ul>
    </div>
    <div class="d-flex gap-5">
        <div style="width: 800px;">
            <div class="m-3 p-4">
                <div class="my-3">
                    <h3>Shipping Address</h3>
                </div>
                <div>
                    <form action="{{ route('savePlaceOrder') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select name="location" class="form-select" id="country">
                                        <option value="Palestine">Palestine</option>
                                        <option value="Egypt">Egypt</option>
                                    </select>
                                    <label for="country">Location <span style="color: red">*</span></label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="First Name*">
                                    <label for="first_name">First Name <span style="color: red">*</span></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" id="last_name" name="last_name" class="form-control"
                                        placeholder="Last Name*">
                                    <label for="last_name">Last Name*</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 d-flex">
                                <select name="" class="form-select w-25">
                                    <option value="">Is +972</option>
                                    <option value="">PS +970</option>
                                </select>
                                <div class="form-floating flex-grow-1">
                                    <input type="text" name="phone" placeholder="Phone Number"
                                        class="form-control w-100">
                                    <label for="phone">Phone Number <span style="color: red">*</span></label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="city" class="form-control" placeholder="City*"
                                        id="city">
                                    <label for="city">City <span style="color: red">*</span></label>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="state" class="form-control" placeholder="State (Optional)"
                                        id="state">
                                    <label for="state">State (Optional)</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="address" placeholder="Address Line" class="form-control">
                                    <label for="address">Address Line</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="national" placeholder="National ID Number"
                                        class="form-control">
                                    <label for="national">National ID Number</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 text-center">
                                <button class="btn px-5 py-2 w-75"
                                    style="background-color: var(--mainColor);color: white">Save</buttonc>
                            </div>
                        </div>
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
                        <p class="mb-1 discount w-25">-US ${{ Auth::guard('web')->user()->cart->discount }}</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Subtotal</p>
                        <p class="mb-1 w-25">US ${{ Auth::guard('web')->user()->cart->sub_total }}</p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Shipping</p>
                        <p class="mb-1 w-25 shipping-city">US
                            {{ Auth::guard('web')->user()->cart->shipping != 0 ? '$' . Auth::guard('web')->user()->cart->shipping : '$0' }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <p class="mb-1">Estimated total</p>
                        <p class="mb-1 w-25">US ${{ Auth::guard('web')->user()->cart->estimated_total }}</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <h5>Coupon Code</h5>
                <div class="d-flex gap-4">
                    <div class="flex-grow-1">
                        <input type="text" name="" class="form-control  p-2" id="">
                    </div>
                    <div class="w-25">
                        <button class="btn w-100" style="background-color: var(--mainColor);color: white">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let cityInput = document.querySelector('#city');
        cityInput.onblur = (e) => {
            $.ajax({
                method: 'POST',
                url: "{{ route('cityDiscount') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'city': cityInput.value
                },
                success: function(res) {
                    if (res.status == 200) {
                        document.querySelector('.shipping-city').textContent = ' Us $' +
                            res
                            .price;
                    }
                },

            });
        }
    </script>
@endpush
