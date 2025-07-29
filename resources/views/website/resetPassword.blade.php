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
                        <h5 class="modal-title" id="SignIn">Reset Password !</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <p>Enter the code sent to {{ session('email') }} to reset your password !</p>
                        </div>

                        <div class="mb-1">
                            <label for="password">Password</label>
                            <div class="d-flex gap-5 text-center reset-password">
                                <div class="d-flex gap-2">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                </div>
                                <div class="d-flex gap-2">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                    <input type="text" class="px-3 code-input" maxlength="1">
                                </div>
                                <input type="hidden" id="hiddenCode" name="code">
                            </div>
                        </div>
                        <div class="mt-3 mb-1 d-flex justify-content-center">
                            <button class="btn" id="verifyCode">Send Code</button>
                        </div>
                        <div class="mt-3 mb-1">
                            <h5 style="color:green" class="d-none" id="codeVerified">Code Verified</h5>
                            <hr>
                        </div>
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div class="mb-2">
                            <label for="new_password">New Password</label>
                            <input type="password" disabled name="new_password" class="form-control" id="new_password"
                                placeholder="********">
                        </div>
                        <div class="mb-2">
                            <p class="mb-0" id="lengthValidation">Minimum 8 characters</p>
                            <p class="mb-0" id="lowerValidation">At least one lowercase letter</p>
                            <p class="mb-0" id="upperValidation">At least one Uppercase letter</p>
                            <p class="mb-0" id="digitValidation">At least one Number letter</p>
                        </div>
                        <div class="mb-1">
                            <button class="btn w-100 order-btn" disabled id="resetPassword">Reset Password</button>
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

        const inputs = document.querySelectorAll('.code-input');
        const hiddenInput = document.getElementById('hiddenCode');

        function updateHiddenInput() {
            let combined = '';
            inputs.forEach(input => {
                combined += input.value;
            });
            hiddenInput.value = combined;
        }

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenInput();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
                setTimeout(updateHiddenInput, 0);
            });

        });

        document.getElementById('verifyCode').onclick = (e) => {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: "{{ route('verifyCode') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'email': "{{ session('email') }}",
                    'code': document.getElementById('hiddenCode').value
                },
                success: function(res) {
                    document.getElementById('codeVerified').classList.remove('d-none');
                    document.getElementById('new_password').removeAttribute('disabled');
                    document.getElementById('verifyCode').classList.add('d-none');

                }
            })
        };
    </script>

    <script>
        let passwordInput = document.getElementById('new_password');
        let lengthValidation = document.getElementById('lengthValidation');
        let lowerValidation = document.getElementById('lowerValidation');
        let upperValidation = document.getElementById('upperValidation');
        let digitValidation = document.getElementById('digitValidation');
        let sendForm = document.getElementById('resetPassword');


        passwordInput.onkeyup = (e) => {
            value = passwordInput.value;
            let errors = [];
            if (value.length >= 8) {
                lengthValidation.style.color = "green";
            } else {
                lengthValidation.style.color = "gray";
                errors.push("lengthValidation");
            }
            if (value.match(/[0-9]/g)) {
                digitValidation.style.color = "green";
            } else {
                digitValidation.style.color = "gray";
                errors.push("digitValidation");
            }
            if (value.match(/[a-z]/g)) {
                lowerValidation.style.color = "green";
            } else {
                lowerValidation.style.color = "gray";
                errors.push("lowerValidation");
            }
            if (value.match(/[A-Z]/g)) {
                upperValidation.style.color = "green";
            } else {
                upperValidation.style.color = "gray";
                errors.push("upperValidation");
            }


            if (errors.length > 0) {
                sendForm.setAttribute("disabled", "disabled");
            } else {
                sendForm.removeAttribute("disabled");
            }
        };
    </script>
@endpush
