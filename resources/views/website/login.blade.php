@extends('website.layout')

@push('script')
@endpush

@section('content')
    <div class="d-flex" style="background-color: #eee">
        <div class="p-5" style="height: 500px">
            <h1 style="font-size: 60px">Welcome To Our Vexora Store</h1>
            <p class="mt-4" style="font-size: 25px">We're truly glad to have you here. At our store, you'll
                find
                everything
                you need - from the latest trends to everyday essentials - all
                carefully selected to bring you the best experience.</p>
            <a href="{{ route('categories') }}" class="btn my-5" id="guest">Continuo as Guest</a>
        </div>
        <div>
            <img src="{{ asset('website/images/imageOne.jpg') }}" alt="" width="500px" height="500px">
        </div>
    </div>
    <div class="p-3 m-4">
        <h3 class="text-center mb-4">Your satisfaction is our priority</h3>
        <div id="priority">

            @foreach ($services as $service)
                <div class="d-flex mx-auto">
                    <div class="me-3">
                        <img src="{{ $service->img_path }}" width="50px" alt="">
                    </div>
                    <div class="p-2 content-service">
                        <h3>{{ $service->name }}</h3>
                        <p>Get your orders delivered within 2-3 busuness days, whenever you are .</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Sign In --}}
    <div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="SignIn" aria-hidden="true">
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
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>

                        <div class="mb-1 wrapper-password">
                            <label for="password">Password</label>
                            <div>
                                <input type="password" name="password" id="password" autocomplete="false">
                                <i class="fas fa-eye-slash"></i>
                            </div>
                            <a href="{{ route('forgot-password') }}" style="color: blue;text-decoration: underline">forget
                                password?</a>
                        </div>

                        <div class="mb-1 p-2">
                            <input type="checkbox" name="remember_me" style="display: inline;width: 25px;">
                            <label for="remember_me">keep me logged in</label>
                        </div>
                        <div class="mb-3">
                            <button class="btn d-block mx-auto" style="background-color: var(--mainColor);color: white">Sign
                                In</button>
                        </div>
                        <div class="divider">
                            <span>OR</span>
                        </div>

                        <div class="mb-2 login-with">
                            <a href="{{ route('auth.socialite.redirect', 'google') }}" class="btn"><i
                                    class="fa-brands fa-google"></i> Continue with
                                google</a>
                        </div>
                        <div class="text-center">
                            <p>Don't have an account ? <a href="{{ route('registerUser') }}" id="signUp">sign
                                    up</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('SignInModal'));
            myModal.show();
        });
    </script>
@endpush
