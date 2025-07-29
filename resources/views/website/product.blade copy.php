@extends('website.layout')

@section('title', 'Single Product')
@section('content')
    <div class="d-flex justify-content-between mx-3 p-3">
        <div class="flex-grow-1">
            <div class="images-product">
                <div class="image-gallery">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                </div>
                <div class="main-image flex-grow-1">
                    <img src="{{ asset('website/images/1.png') }}" alt="">
                </div>
            </div>
            <div class="reviews p-5 mx-2">
                <div>
                    <h1>Customer Review</h1>
                    <div class="px-5 py-4" style="background-color: #eee">
                        <div class="d-flex align-items-center">
                            <h1>5.00</h1>
                            <div class="ms-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div>
                            <h4>Over Fit:</h4>
                            <div class="d-flex justify-content-between">

                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 650px" class="p-1">
            <p class="description" style="font-size: 19px;font-weight: 400;">
                <button class="trend">Trends</button>
                Manfinity Mode Men s Fashion Casual Business
                Commuting Men s Stand-Up Collar Solid Color Button Long
                Sleeve Shirt, Men s Formal Shirt, Men s Solid Color Shirt.
                Suitable For Daily Wear, Commuting To Work, Going Out,

                Party, Can Be Paired With Suit Pants Or Suit Suits To Attend
                Parties, Weddings, Honeymoon Scenes. Can Be Given As A
                Gift To Sons, Husbands, Boyfriends, Fathers.
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>Au$29.99</h4>
                </div>
                <div>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </div>
                <div class="me-5 p-1">
                    <p class="text-warning">(+1000 Reviews)</p>
                </div>
            </div>
            <hr>
            <div class="attributes">
                <div class="Color">
                    <div class="attribute-title">
                        <p><span style="font-weight: bold;font-size: 20px">Color:</span> Navy Blue</p>
                        <div class="attribute-body">
                            <div class="d-flex flex-wrap gap-3" style="width: 280px">
                                <div class="color-wrapper">
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: navy;padding: 5px;border: 1px solid black;box-sizing: border-box;">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #52859c;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #492d2d;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #696969;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #215d48;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: white;padding: 5px;border: 1px solid rgb(173, 171, 171)">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: black;padding: 5px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Size mt-3">
                    <div class="attribute-title">
                        <p><span style="font-weight: bold;font-size: 20px">Size:</span> Large</p>
                        <div class="attribute-body">
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <div style="width: 80%;text-align: center">
                    <button class="btn py-3 px-5"
                        style="width: 70%;background-color: var(--mainColor);color: white;font-weight: bold">Add
                        To Cart</button>
                </div>
                <div>
                    <button class="btn mx-auto"><i class="fas fa-heart"></i></button>
                </div>
            </div>
            <div class="my-3 p-4" style="background-color: #f4f4f4">
                <p style="font-size: 20px"><span style="font-weight: bold">Shipping to</span> Palestine</p>
                <div class="p-1">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px" alt="">
                        <p class="mt-3 ms-2">Free standard shipping on orders over AU$76.96</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px" alt="">
                        <p class="mt-3 ms-2">Return Policy</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px" alt="">
                        <p class="mt-3 ms-2">Shopping Security</p>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly">
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Safe
                        Payments</button>
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Customer
                        Service</button>
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Secure
                        Logistics</button>
                </div>
            </div>
            <div>

                <h4>Description</h4>
                <div class="d-flex justify-content-start">
                    <div style="width: 200px;">
                        <p class="m-0">Scenes:</p>
                        <p class="m-0">Ideal for:</p>
                        <p class="m-0">Sleeve Type:</p>
                        <p class="m-0">Hem Shaped:</p>
                        <p class="m-0">Type:</p>
                        <p class="m-0">Details:</p>
                        <p class="m-0">Pattern Type:</p>
                        <p class="m-0">Style:</p>
                        <p class="m-0">Placket:</p>
                        <p class="m-0">Color:</p>
                        <p class="m-0">Neckline:</p>
                        <p class="m-0">Sleeve Length:</p>
                        <p class="m-0">Fit Type:</p>
                        <p class="m-0">Length:</p>
                        <p class="m-0">Material:</p>
                        <p class="m-0">Composition:</p>
                        <p class="m-0">Care Instructions:</p>
                        <p class="m-0">Sheer:</p>
                        <p class="m-0">Fabric:</p>
                        <p class="m-0">SKU: </p>
                    </div>
                    <div class="flex-grow-1">
                        <p class="m-0">Formal Business</p>
                        <p class="m-0">conventional</p>
                        <p class="m-0">Regular Sleeve</p>
                        <p class="m-0">Regular</p>
                        <p class="m-0">Shirt</p>
                        <p class="m-0">Button</p>
                        <p class="m-0">Plain</p>
                        <p class="m-0">Business - Formal Business</p>
                        <p class="m-0">Single Breasted</p>
                        <p class="m-0">Navy Blue</p>
                        <p class="m-0">Shirt Collar</p>
                        <p class="m-0">Long Sleeve</p>
                        <p class="m-0">Regular Fit</p>
                        <p class="m-0">Regular</p>
                        <p class="m-0">Polyester</p>
                        <p class="m-0">95% Polyester, 5% Elastane</p>
                        <p class="m-0">Machine wash or professional dry clean</p>
                        <p class="m-0">Semi Sheer</p>
                        <p class="m-0">Slight Stretch</p>
                        <p class="m-0">sm2410105799153398</p>
                    </div>
                </div>
            </div>
            <div class="my-3 size">
                <h4>Size & Fit</h4>
                <div>
                    <button class="btn active">CM</button>
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <i class="fas fa-long-arrow-alt-right"></i>
                    <button class="btn">IN</button>
                    <div class="d-flex my-3 Size-type">
                        <p class="active">Product Measurements</p>
                        <p class="ms-4">Body Measurements</p>
                    </div>
                    <div class="my-3 table">
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>Size</td>
                                <td>Shoulder</td>
                                <td>Bust</td>
                                <td>Length (L)</td>
                                <td>Sleeve (L)</td>
                                <td>Bicep (L)</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                        </table>

                    </div>
                    <div class="p-2">
                        <li>This data was obtained from manually measuring the product, it may be off by
                            1-2
                            CM.</li>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
