@extends('website.master')
@section('content')
    {{-- content here --}}
    <div class="swiper mySwiper m-1 my-3 p-3" style="background-color: #faedea">
        <div class="mb-1">
            <h3 class="text-bg-light p-3">love farah</h3>
        </div>
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">

                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card" style="border: none">
                        <img src="{{ $product->img_path }}" style="style="object-fit: cover;border-radius: 10px"
                            height="200px"" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text my-2">${{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Navigation arrows -->
        <div class="swiper-button-prev custom-swiper-prev">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="swiper-button-next custom-swiper-next">
            <i class="fa-solid fa-chevron-right"></i>
        </div>

    </div>
    <div class="row">
        <div class="px-3 my-1 mx-3">
            <h3 class="text-warning">Handpicked for you</h3>
        </div>

        <div class="d-flex justify-content-start flex-wrap grid-5 mx-3 p-3">
            @foreach ($products as $product)
                <div class="card" style="border: none">
                    <img src="{{ $product->img_path }}" style="object-fit: cover;border-radius: 10px" height="200px"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <div class="d-flex justify-content-between">
                            @php
                                $rating = 3;
                            @endphp
                            <div>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>100 user</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="card-text" style="height: 20px">
                                ${{ $product->price }}</p>
                            <p class="card-text" style="height: 20px"><i class="fas fa-shopping-cart"></i>
                            </p>
                        </div>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
