<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="{{ asset('website/master.css') }}">

        <title>Document</title>
        <style>

        </style>
    </head>

    <body>

        <div class="header">
            <nav class="d-flex justify-content-between align-items-center">
                <div class="me-4 header-logo">
                    <img src="{{ asset('website/images/logo.jpeg') }}" alt="">
                </div>
                <div class="flex-grow-1">
                    <form action="" method="get" id="search">
                        <div class="d-flex">
                            <input type="text" class="form-control"
                                placeholder="Search Products, Brands and Category">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <ul class="d-flex justify-content-between flex-row-reverse align-items-center">
                    <li class="mx-4"><i class="fas fa-shopping-cart"></i></li>
                    <li class="mx-4"><i class="fas fa-heart" style="color: red"></i></li>
                    <li class="mx-4"><button class="btn">{{ app()->getLocale() }}/ USD</button></li>
                    <li class="mx-4"><button class="btn" data-bs-toggle="modal" data-bs-target="#SignInModal"><i
                                class="fas fa-user"></i> Sign In</button></li>
                </ul>

            </nav>
        </div>


        <div class="main my-2">
            @include('includes.buttonCategory')
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
                                <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px"
                                    alt="">
                                <p class="mt-3 ms-2">Free standard shipping on orders over AU$76.96</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px"
                                    alt="">
                                <p class="mt-3 ms-2">Return Policy</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px"
                                    alt="">
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
        </div>

        <footer class="px-5 pt-5" style="background-color: #f0f0f0">
            <div class="d-flex justify-content-around">
                <div>
                    <ul>
                        <h4>Shop</h4>
                        <li><a href="#">Gift cards</a></li>
                        <li><a href="#">Vexora Registry</a></li>
                        <li><a href="#">Sitemap</a></li>
                        <li><a href="#">Vexora Blog</a></li>
                        <li><a href="#">Vexora UK</a></li>
                        <li><a href="#">Vexora Germany</a></li>
                        <li><a href="#">Vexora Canada</a></li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <h4>Sell</h4>
                        <li><a href="#">Seller Dashboard</a></li>
                        <li><a href="#">Community Forums</a></li>
                        <li><a href="#">Affiliates & Creators</a></li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <h4>About</h4>
                        <li><a href="#">Policies</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press & Media</a></li>
                        <li><a href="#">Sustainability & Impact</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Legal Notice</a></li>
                    </ul>
                </div>

                <div>
                    <ul>
                        <h4>Help</h4>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy setting</a></li>
                    </ul>
                    <div>
                        <div class="footer-logo">
                            <img src="{{ asset('website/images/logo.png') }}" width="150px" height="150px"
                                alt="">
                        </div>
                        <div style="margin: 0 30px">
                            <i class="fas fa-facebook"></i>
                            <i class="fas fa-instagram"></i>
                            <i class="fas fa-twitter"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-around mt-4">
                <p>copyright © 2025-Vexor Inc. All right reserved.</p>
                <p>Dont share my personal information <span id="Privacy">Privacy settings</span></p>
            </div>
        </footer>



        {{-- Sign In --}}
        <div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="SignIn"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div style="">
                            <button class="close" style="border: none" type="button" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div>
                            <h5 class="modal-title" id="SignIn">Sign In</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="mb-1">
                                <label for="email">Email</label>
                                <input type="email" name="email">
                            </div>

                            <div class="mb-1 wrapper-password">
                                <label for="password">Password</label>
                                <div>
                                    <input type="password" name="password">
                                    <i class="fas fa-eye-slash"></i>
                                </div>
                            </div>

                            <div class="mb-1 p-2">
                                <input type="checkbox" name="remember_me" style="display: inline;width: 25px;">
                                <label for="remember_me">keep me logged in</label>
                            </div>
                            <div class="mb-3">
                                <button class="btn d-block mx-auto"
                                    style="background-color: var(--mainColor);color: white">Sign
                                    In</button>
                            </div>
                            <div class="signOR my-3">
                                <button type="button">Or</button>
                                <hr>
                            </div>

                            <div class="mb-2 login-with">
                                <button type="button" class="btn"><i class="fas fa-google"></i> Continue with
                                    google</button>
                                <button type="button" class="btn"><i class="fas fa-facebook"></i> Continue with
                                    facebook</button>
                                <button type="button" class="btn"><i class="fas fa-app-store"></i> Continue with
                                    Apple</button>
                            </div>
                            <div class="text-center">
                                <p>Don't have an account ? <a href="" id="signUp">sign up</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sign In --}}
        <div class="modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="SignUpModal">Sign Up</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('registerUser') }}" method="POST" id="FormRegister">
                        @csrf
                        <div class="modal-body">
                            <div class="bm-1">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="register">
                            </div>

                            <div class="bm-1">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="register">
                            </div>
                            <div class="bm-1">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="register">
                            </div>

                            <div class="bm-1">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="register">
                            </div>
                            <div class="bm-1">
                                <label for="password_confirmation">Password Again</label>
                                <input type="password" name="password_confirmation" class="register">
                            </div>
                            <div class="bm-1">
                                <label for="type">Type User</label>
                                <label class="ms-3">User</label>
                                <input type="radio" name="type" value="user" class="p-1 register">
                                <label class="ms-1">Supplier</label>
                                <input type="radio" name="type" value="supplier" class="p-1 register">
                            </div>
                            <div class="mb-1">
                                <label>A gree for use website</label>
                                <input type="checkbox" name="condition" id="condition">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" disabled id="btn_register"
                                type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let checkBox = document.querySelector('#condition');
            checkBox.onchange = () => {
                if (checkBox.checked) {
                    btn_register.removeAttribute('disabled');
                } else {
                    btn_register.setAttribute('disabled', 'disabled');
                }
            }

            let form = document.querySelector('#FormRegister');
            form.onsubmit = (e) => {
                e.preventDefault();
                let inputs = form.querySelectorAll('input');
                let data = new FormData(form);
                let errorsInputs = [];
                let typeChecked = false;

                inputs.forEach(el => {
                    if (el.value == '') {
                        if (el.name == 'password_confirmation') {
                            let password = form.querySelector('[name=password]');
                            if (el.value != password.value) {
                                errorsInputs.push('The password not matching');
                            }
                            return;
                        }
                        errorsInputs.push('the field ' + el.name + ' is required');
                    }

                    if (el.checked && el.name === 'type') {
                        typeChecked = true;
                    }
                })
                if (!typeChecked) {
                    errorsInputs.push('Please select a type');
                }
                if (errorsInputs.length > 0) {
                    console.log(errorsInputs);
                } else {
                    form.submit();
                }

            }
        </script>

        <script>
            let btnSignUp = document.querySelector("#signUp")
            btnSignUp.onclick = (e) => {
                e.preventDefault();
                alert(1)
            }
        </script>
    </body>

</html>
