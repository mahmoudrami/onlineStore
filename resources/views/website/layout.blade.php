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

        <link rel="shortcut icon" href="{{ asset('images/الايقونة.png') }}">

        <title>@yield('title', config('app.name'))</title>
        @stack('css')

    <body>

        <div class="header">
            <nav class="d-flex justify-content-between align-items-center">
                <div class="me-4 header-logo">
                    <a href="{{ route('homePage') }}"><img src="{{ asset('website/images/logo.jpeg') }}" alt=""
                            width="100"></a>
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
                    <li class="mx-4"><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a></li>
                    <li class="mx-4"><a href="{{ route('userWishlist') }}" class="btn text-danger"><i
                                class="fas fa-heart"></i></a></li>
                    @if (!Auth::check())
                        <li class="mx-4"><a href="{{ route('login') }}" class="btn"><i class="fas fa-user"></i>
                                Sign In</a></li>
                    @else
                        <li class="mx-4 text-center">
                            <div class="dropdown text-center account">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Account
                                </button>
                                <ul class="dropdown-menu text-left" style="width: 280px;left: -75px">
                                    <li class="dropdown-item">
                                        <div class="d-flex justify-content-between gap-1">
                                            <div>
                                                <img width="20px" height="20px"
                                                    src="{{ Auth::guard('web')->user()->img_path }}" alt="">
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{ Auth::guard('web')->user()->name }}
                                            </div>
                                        </div>
                                    </li>
                                    <hr>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                                class="fas fa-user-circle"></i> My
                                            Account</a></li>

                                    <li><a class="dropdown-item" href="{{ route('userWishlist') }}"><i
                                                class="fa fa-heart"></i> Wish
                                            List</a></li>
                                </ul>
                            </div>
                        </li>
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
            <div class="d-flex justify-content-around align-items-center mt-4">
                <p>copyright © 2025-Vexor Inc. All right reserved.</p>
                <p>Dont share my personal information <span id="Privacy">Privacy settings</span></p>
            </div>
        </footer>


        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script> --}}

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

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            document.querySelectorAll('.fa-eye-slash').forEach((el) => {
                el.onclick = () => {
                    let parent = el.closest('div');

                    let password_input = parent.querySelector('input');
                    if (password_input.type == 'password') {
                        password_input.setAttribute('type', 'text');
                        el.classList.remove('fa-eye-slash')
                        el.classList.add('fa-eye')

                    } else {
                        password_input.setAttribute('type', 'password');
                        el.classList.add('fa-eye-slash')
                        el.classList.remove('fa-eye')
                    }
                }
            })
        </script>

        <script>
            function showImage(e) {
                const [file] = e.target.files
                if (file) {
                    prevImage.src = URL.createObjectURL(file)
                }
            }
        </script>

        <script>
            document.querySelectorAll('.wishList').forEach(el => {
                el.onclick = () => {
                    let id = el.getAttribute('data-id')
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('ItemToWishlist') }}" + '/' + id,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(res) {
                            if (res.status == 201) {
                                if (!el.classList.contains('text-danger')) {
                                    el.classList.add('text-danger')
                                }
                            } else {
                                if (el.classList.contains('text-danger')) {
                                    el.classList.remove('text-danger')
                                }
                            }
                        },
                        error: function(err) {
                            if (err.status == 401) {
                                window.location.href = '{{ route('login') }}'
                            }
                        }
                    });
                }
            });
        </script>

        <script>
            document.querySelectorAll('.cart').forEach(el => {
                console.log(document.querySelectorAll('.cart'));

                el.onclick = () => {
                    let id = el.getAttribute('data-id');
                    alert('cart')
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('addItemToCart') }}" + '/' + id,
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                alert(res.data)
                            }
                        },
                        error: function(err) {
                            if (err.status == 401) {
                                window.location.href = '{{ route('login') }}'
                            }
                        }
                    });
                }
            })
        </script>
        @stack('script')

    </body>

</html>
