@extends('website.layout')

@section('content')
    @include('includes.buttonCategory')
    <div class="d-flex justify-content-start flex-wrap grid-5 mx-3 p-3">
        @foreach ($categories as $category)
            <div class="category-item">
                <div class="category-circle">
                    <a href="{{ route('category', $category->id) }}"><img src="{{ $category->img_path }}"
                            alt="{{ $category->name }}"></a>
                </div>
                <div class="category-name">
                    <a href="{{ route('category', $category->id) }}">
                        <h4>{{ $category->name }}</h4>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="swiper mySwiper m-1 my-3 p-3" style="background-color: #faedea">
        <div class="mb-1 header-swiper">
            <img src="{{ asset('website/images/down-arrow.png') }}" width="50px" alt="">
            <h3 class="p-3">Super Deals</h3>
        </div>
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    <div class="card">
                        <div>
                            <a href="{{ route('product', $product->id) }}"><img src="{{ $product->img_path }}"
                                    class="card-img-top" alt="{{ $product->name }}"></a>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">
                                @php
                                    $priceAfterDiscount = $product->price - $product->getTodayDiscount();
                                    $priceArray = explode('.', $priceAfterDiscount);
                                    $firstPrice = $priceArray[0];
                                    $secondPrice = $priceArray[1] ?? 0;
                                @endphp
                                $<span>{{ $firstPrice }}</span>.{{ $secondPrice }}
                            </h3>
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
    <div class="m-4">
        <div class="my-5 text-center">
            <h3>you may also like</h3>
        </div>

        <div class="products">
            @foreach ($products as $product)
                <div class="product">
                    <div class="product-image text-center">
                        <img src="{{ $product->img_path }}" alt="">
                    </div>
                    <div class="product-title">
                        <a href="{{ route('product', $product->id) }}">
                            <p>{{ $product->name }}</p>
                        </a>
                    </div>
                    <div class="product-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($product->rate <= $i)
                                        <i class="fas fa-star mx-sm-1"></i>
                                    @else
                                        <i class="fas fa-star mx-sm-1 text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>{{ $product->sold }} sold</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-size: 20px;font-weight: 500;margin: 0 10px">${{ $product->price }}</p>
                            <button class="btn cart" data-id="{{ $product->id }}"><i
                                    class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.querySelectorAll('.addCartItem').forEach(el => {
            el.onclick = () => {
                let id = el.getAttribute('data-id');
                $.ajax({
                    method: 'POST',
                    url: "{{ route('addItemToCart') }}" + '/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(res) {
                        if (res) {
                            alert(res.data)
                        }
                    }
                });
            }

        });
    </script>
@endpush
