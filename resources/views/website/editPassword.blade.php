@extends('website.layout')

@section('title', 'Edit Password')

@section('content')
    <div class="row mx-auto" style="background-color: #f7f7f7;padding: 10px">
        <div class="col-4 mx-auto profile-setting">
            <div class="btn-settings">
                <a href="{{ route('profile') }}" class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"><i
                        class="fas fa-user"></i> Edit
                    Profile</a>
                <a href="{{ route('editPassword') }}"
                    class="{{ Route::currentRouteName() == 'editPassword' ? 'active' : '' }}"><i class="fas fa-lock"></i>
                    Password</a>

                <hr>
                <a href="{{ route('profile') }}"><i class="fas fa-user"></i> Sign Out</a>
                <a href="{{ route('deleteAccount') }}" class="delete-account"><i class="fas fa-close"></i> Delete
                    Account</a>

            </div>
        </div>
        <div class="col-5 mx-auto">
            <div class="row">
                <h1>Password</h1>
                <hr>
                <div class="edit-profile">
                    <div id="edit-password">
                        <form action="{{ route('editPassword') }}" method="post" style="width: 500px">
                            @csrf
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="old_password" class="my-2">Enter Old Password</label>
                                    <input type="password" id="old_password" name="old_password" class="form-control"
                                        placeholder="Old Password">
                                    @error('old_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <i class="fas fa-eye-slash"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="new_password" class="my-2">Enter New Password</label>
                                    <input type="password" id="new_password" name="new_password" disabled
                                        class="form-control" placeholder="New Password">
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <i class="fas fa-eye-slash"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="new_password_confirmation" class="my-2">Enter Again New Password</label>
                                    <input type="password" id="new_password_confirmation" disabled
                                        name="new_password_confirmation" class="form-control"
                                        placeholder="Enter Again New Password">
                                    <i class="fas fa-eye-slash"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 submit-form">
                                    <button id="submitChangePassword" disabled="true" class="btn">Change
                                        Password</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let oldPassword = document.querySelector('#old_password');
        let newPassword = document.querySelector('#new_password');
        let newAgainPassword = document.querySelector('#new_password_confirmation');

        oldPassword.onblur = (e) => {
            if (oldPassword.value.length > 0) {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('checkPassword') }}",
                    data: {
                        // '_token': '{{ csrf_token() }}',
                        'old_password': oldPassword.value
                    },
                    success: function(res) {
                        if (res) {
                            document.querySelector('#submitChangePassword').removeAttribute('disabled');
                            newPassword.removeAttribute('disabled');
                            newAgainPassword.removeAttribute('disabled');
                        } else {
                            alert('success ajax and old password not equal to new password');
                        }
                    }
                });
            }

        }
    </script>
@endpush
