@extends('website.layout')

@section('content')
    <div class="d-flex" style="background-color: #eee">
        <div class="p-5" style="height: 500px">
            <h1 style="font-size: 60px">Welcome To Our Vexora Store</h1>
            <p class="mt-4" style="font-size: 25px">We're truly glad to have you here. At our store, you'll
                find
                everything
                you need - from the latest trends to everyday essentials - all
                carefully selected to bring you the best experience.</p>
            <button class="btn my-5" id="guest">Continuo as Guest</button>
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
@endsection
