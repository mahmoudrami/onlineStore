<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="{{ asset('website/master.css') }}">

        <title>@yield('title', config('app.name'))</title>

    <body>

        <div class="header">
            <nav class="d-flex justify-content-between align-items-center">
                <div class="me-4 header-logo">
                    <img src="{{ asset('website/images/logo.jpeg') }}" alt="" width="100">
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
                <ul class="d-flex justify-content-between flex-row-reverse align-items-center m-3">
                    <li class="mx-4"><i class="fas fa-shopping-cart"></i></li>
                    <li class="mx-4"><a href="{{ route('userWishlist') }}" class="btn text-danger"><i
                                class="fas fa-heart"></i></a></li>
                    <li class="mx-4"><button class="btn">{{ app()->getLocale() }}/ USD</button></li>
                    @if (!Auth::check())
                        <li class="mx-4"><button class="btn" data-bs-toggle="modal"
                                data-bs-target="#SignInModal"><i class="fas fa-user"></i> Sign In</button></li>
                    @else
                        <li class="mx-4 account"><button class="btn"><i class="fas fa-user"></i>
                                Account</button>
                        </li>
                        <div>
                            <ul>
                                <li>
                                    <div class="row">
                                        <div class="col-5">
                                            <img src="{{ asset('website/images/1.png') }}" class="user-image"
                                                alt="">
                                        </div>
                                        <div class="col-7">
                                            <h6>welcome {{ Auth::user()->name }}</h3>
                                        </div>
                                    </div>
                                </li>
                                <li>Account</li>
                                <li>Account</li>
                                <li>Account</li>
                            </ul>
                        </div>
                    @endif

                </ul>

            </nav>
        </div>


        <div class="main my-2 p-3">
            @yield('content')
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
                                <p>Don't have an account ? <button type="button" href="" id="signUp">sign
                                        up</button></p>
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
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 5, // ← بدّلها من 3 إلى 5
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: ".custom-swiper-next",
                    prevEl: ".custom-swiper-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 5, // ← على الشاشات الكبيرة يظهر 5 منتجات
                    },
                },
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            let btnSignUp = document.querySelector("#signUp")
            btnSignUp.onclick = (e) => {
                let currentModal = document.getElementById('SignInModal');
                var nextModal = new bootstrap.Modal(document.getElementById('SignUpModal'));
                let modalInstance = bootstrap.Modal.getInstance(currentModal);
                modalInstance.hide();

                nextModal.show();

            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.querySelectorAll('.fa-eye-slash').forEach((el) => {
                el.onclick = () => {
                    const modal1El = document.getElementById('SignInModal');
                    const modal1 = bootstrap.Modal.getInstance(modal1El);
                    const modal2 = new bootstrap.Modal(document.getElementById('SignUpModal'));

                    // انتظر حتى يُغلق المودال الأول تمامًا
                    modal1El.addEventListener('hidden.bs.modal', function() {
                        modal2.show();
                    }, {
                        once: true
                    });

                    modal1.hide();
                }
            })

            document.querySelector('.account button')?.addEventListener("click", () => {
                alert(1);
            })
        </script>
        <!-- Custom scripts for all pages-->
        @stack('script')

    </body>

</html>
