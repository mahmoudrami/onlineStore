@extends('website.layout')

@section('title', 'Profile')

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
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button><i class="fas fa-user"></i> Sign Out</button>
                </form>


                <form action="{{ route('deleteAccount') }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="delete-account"><i class="fas fa-close"></i> Delete Account</button>
                </form>


            </div>
        </div>
        <div class="col-5 mx-auto">
            <div class="row" id="Edit Profile">
                <h1>Edit Profile</h1>
                <hr>
                <div class="edit-profile">
                    <div id="edit-profile">
                        <form action="{{ route('editProfile') }}" method="post" style="width: 500px"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row my-3">
                                <div class="col-4">
                                    <label for="image"><img class="image-user" id="prevImage" src="{{ $user->img_path }}"
                                            alt=""></label>
                                </div>
                                <div class="col-8 d-flex align-items-center position-relative">
                                    <input type="file" onchange="showImage(event)" name="image" style="display: none"
                                        id="image">
                                    <button type="button" class="upload-image"><label for="image"><i
                                                class="fas fa-download upload-icon"></i> Upload
                                            New
                                            Photo</label></button>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="name" class="my-2">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control" placeholder="Name">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="email" class="my-2">Email</label>
                                    <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control" placeholder="Name">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 wrapper">
                                    <label for="location" class="my-2">Location</label>
                                    <input type="text" name="location" value="{{ old('location', $user->location) }}"
                                        class="form-control" placeholder="Name">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12">
                                    <label for="bio" class="my-2">Bio</label>
                                    <textarea type="text" name="bio" class="form-control" placeholder="Name" rows="5">{{ old('bio', $user->bio) }}</textarea>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12 submit-form">
                                    <button class="btn">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
