<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <title>Document</title>
        <style>
            .category-btn {
                border-radius: 50px;
                padding: 8px 25px;
                background-color: white;
                border: none;
                margin: 5px;
                transition: 0.3s;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                color: #000;
            }

            .btn-nav {
                border-radius: 50px;
                padding: 8px 15px;
                background-color: white;
                border: none;
                margin: 5px;
                transition: 0.3s;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                color: #000;
            }

            .category-btn:hover,
            .category-btn.active {
                background-color: #000;
                color: rgb(255, 255, 255)
            }

            .category-circle {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                overflow: hidden;
                border: 1px solid #ddd;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: auto;
            }

            .category-circle img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .category-name {
                text-align: center;
                margin-top: 10px;
                font-weight: bold;
                text-transform: capitalize;
            }

            .grid-5>div {
                width: 20%;
                padding: 5px;
            }

            #search input {
                border-radius: 20px 5px 5px 20px;
            }
        </style>
    </head>

    <body>

        <div class="container my-4">
            <nav class="d-flex justify-content-between align-items-center">
                <div class="me-2">
                    <div class="p-3">
                        {{ env('APP_NAME') }}
                    </div>
                </div>
                <div class="me-2 flex-grow-1">
                    <div class="p-3">
                        <form action="" method="GET" id="search" class="d-flex">
                            <input type="text" name="search" placeholder="Search" class="form-control">
                            <button class="btn btn-sm btn-danger"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="mx-auto">

                    <ul class="d-flex justify-content-start align-items-center flex-row-reverse mt-3"
                        style="list-style: none">

                        @if (Auth::check())
                            <h5 class="ms-2 text-info">{{ Auth::user()->name }}</h5>
                        @else
                            <li class="ms-2">
                                <button class="btn-nav" data-bs-toggle="modal" data-bs-target="#SignInModal">Sign
                                    In</button>
                            </li>
                            <li class="ms-2">
                                <button class="btn-nav" data-bs-toggle="modal" data-bs-target="#SignUpModal">Sign
                                    Up</button>
                            </li>
                        @endif
                        <li class="ms-2">
                            <button class="btn-nav">Sign In</button>
                        </li>
                        <li class="ms-2">
                            <button class="btn-nav">Sign In</button>
                        </li>
                    </ul>

                </div>
            </nav>
            <div class="row">
                <div class="d-flex mx-3 p-3 justify-content-start flex-wrap">
                    <div><button class="category-btn active">All</button></div>
                    @foreach ($categories as $category)
                        <div class="mx-2">
                            <button class="ms-1 category-btn">{{ $category->name }}</button>
                        </div>
                        <div class="mx-2">
                            <button class="ms-1 category-btn">{{ $category->name }}</button>
                        </div>
                        <div class="mx-2">
                            <button class="ms-1 category-btn">{{ $category->name }}</button>
                        </div>
                        <div class="mx-2">
                            <button class="ms-1 category-btn">{{ $category->name }}</button>
                        </div>
                        <div class="mx-2">
                            <button class="ms-1 category-btn">{{ $category->name }}</button>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-start flex-wrap grid-5 mx-3 p-3">
                    @foreach ($categories as $category)
                        <div>
                            <div class="category-circle">
                                <img src="{{ asset('images/categories/11262291221746700947.jpg') }}" alt="">
                            </div>
                            <div class="category-name">
                                <h4>{{ $category->name }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- content here --}}
            @yield('content')
            <div class="row mt-3 mx-3 p-3" style="background-color: #eee">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <ul style="list-style: none">
                            <h4>Shop</h4>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                        </ul>
                    </div>
                    <div class="p-3">
                        <ul style="list-style: none">
                            <h4>Shop</h4>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                        </ul>
                    </div>
                    <div class="p-3">
                        <ul style="list-style: none">
                            <h4>Shop</h4>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                        </ul>
                    </div>
                    <div class="p-3">
                        <ul style="list-style: none">
                            <h4>Shop</h4>
                            <li>farah mahmoud aqel</li>
                            <li>farah mahmoud aqel</li>
                            <span>LOGO</span>
                        </ul>
                    </div>
                </div>
                <hr>
                <footer class="mx-3 p-3">
                    <div class="d-flex justify-content-between">
                        <p class="p-3">copyreight <i class="fas fa-copyright"></i> mahmoud rami aqel All reight
                            reversed</p>
                        <p class="p-3">copyreight <i class="fas fa-copyright"></i> mahmoud rami aqel All
                            <span>reight reversed</span>
                        </p>

                    </div>
                </footer>
            </div>


        </div>

        {{-- Sign In --}}
        <div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="SignIn"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="SignIn">Sign In</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="bm-1">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="bm-1">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary confirmAll" type="submit"
                                data-action="delete">Delete</button>
                        </div>
                    </form>
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
                                <input type="text" name="name" class="form-control register">
                            </div>

                            <div class="bm-1">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="form-control register">
                            </div>
                            <div class="bm-1">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control register">
                            </div>

                            <div class="bm-1">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control register">
                            </div>
                            <div class="bm-1">
                                <label for="password_confirmation">Password Again</label>
                                <input type="password" name="password_confirmation" class="form-control register">
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
    </body>

</html>
