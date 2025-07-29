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

    {{-- Sign Up --}}
    <div class="modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="SignUpModal" aria-hidden="true">
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
                        <div class="mb-1">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="register">
                        </div>

                        <div class="mb-1">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="register" autocomplete="false">
                        </div>
                        <div class="mb-1">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="passwordSignUp" placeholder="*********"
                                class="register" autocomplete="false">
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation"> Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="register"
                                autocomplete="false">
                        </div>
                        <div class="mb-1">
                            <h5>Please select trade role</h5>
                            <div class="d-flex  gap-4 mt-3">
                                <div class="form-check">
                                    <input type="radio" name="type" id="supplier" value="supplier">
                                    <label class="form-check-label" for="supplier">
                                        Buyer
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" name="type" id="user" value="user">
                                    <label class="form-check-label" for="user">
                                        Seller
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label>A gree for use website</label>
                            <input type="checkbox" name="condition" id="condition">
                        </div>

                        <div class="mb-3 submit-form">
                            <button class="btn">Create Account</button>
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
                            <p>Already have an account ? <a type="button" href="{{ route('login') }}"
                                    id="signIp">sign
                                    in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('SignUpModal'));
            myModal.show();
        });
    </script>

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
                alert('select')
            } else {
                form.submit();
            }

        }
    </script>
@endpush
