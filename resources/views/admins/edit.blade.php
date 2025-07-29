@extends('admins.master')
@section('title', 'dashbord')
@section('css')
    <style>
        .prev-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 1px dashed #777676;
            padding: 5px;
            object-fit: cover;
            transition: all .3 ease;
            cursor: pointer;
        }

        .prev-img:hover {
            opacity: .8;
        }

        .prev-img-model {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            align-items: center;
            background: #06060687;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
            display: none;
        }

        .prev-img-model img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
        }

        .pass-wrapper {
            position: relative;
        }

        .pass-wrapper i {
            position: absolute;
            right: 10px;
            top: 12px;

        }
    </style>
@endsection
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <form action="{{ route('admin.editProfile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="prev-img-model">
            <img src="https://via.placeholder.com/300" alt="">
        </div>
        <div class="row">
            <div class="col-3 text-center">
                <img src="{{ $admin->img_path }}" id="previwe" class="prev-img mb-3"><br>
                <label for="image" class="btn btn-sm btn-dark">Edit Image</label>
                <input type="file" name="image" id="image" class="form-control" style="display: none"
                    onchange="showImg(event)">
            </div>
            <div class="col-9">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                        class="form-control
                @error('name') is-invalid @enderror">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" disabled value="{{ $admin->email }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Old Password</label>
                    <div class="pass-wrapper">
                        <input type="password" name="old_password" id="old-password" class="form-control old-password">
                        <i class="fas fa-eye"></i>
                    </div>
                    @error('old_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" disabled class="form-control new">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Confirm Passwrod</label>
                    <input type="password" disabled name="password_confirmation" class="form-control new">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-success"><i class="fas fa-save"></i> Update</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $('.prev-img').click(function() {

            let url = $(this).attr('src')
            $('.prev-img-model img').attr('src', url)

            $('.prev-img-model').css('display', 'flex')
        })
        $('.prev-img-model').click(function() {
            $('.prev-img-model').hide()
        })

        // $('.old-password').keyup(function(){
        //     if($(this).val().length > 0){
        //         $('.new').attr('disabled', false)

        //     }else{
        //         $('.new').attr('disabled', true)
        //     }
        // })
        $('#old-password').blur(function() {
            $.ajax({
                url: '{{ route('admin.checkPassword') }}',
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'password': $(this).val(),
                },
                success: function(res) {
                    if (res) {
                        $('.new').attr('disabled', false);
                        $('#old-password').addClass('is-valid');
                        $('#old-password').removeClass('is-invalid');
                    } else {
                        $('.new').attr('disabled', true);
                        $('#old-password').addClass('is-invalid');
                        $('#old-password').removeClass('is-valid');
                    }
                }
            });

        })
        document.querySelector('.pass-wrapper i').onclick = () => {
            if ($('#old-password').attr('type') == 'password') {
                $('#old-password').attr('type', 'text');
            } else {
                $('#old-password').attr('type', 'password');
            }
        }
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 3000);
    </script>

@endsection
