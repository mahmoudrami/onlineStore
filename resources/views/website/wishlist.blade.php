@extends('website.layout')

@section('title', 'WishList')

@section('content')
    <div class="wishList m-3 p-4">
        <div class="title-wishList uppercase my-3">
            <h3>MY WISHLIST ( {{ count($productsWishlist) }} )</h3>
        </div>
        <div class="d-flex">
            <div class="mx-3 select-all-wishList">
                <input type="checkbox" class="me-3">
                <label for="">Select All Items</label>
            </div>
            <div class="delete">
                <p>Delete Selected Items</p>
            </div>
        </div>
        <div class="d-flex justify-content-start flex-wrap">
            @forelse ($productsWishlist as $product)
                <div class="wishList-item">
                    <div class="image-wishlist">
                        <img src="{{ $product->img_path }}" alt="">
                    </div>
                    <div class="title-wishlist">
                        <h5 class="mb-0">{{ $product->name }}</h5>
                    </div>
                    <div class="content-wishlist">
                        <div>
                            <p class="mb-0">{{ $product->sold }} sold</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-size: 20px;font-weight: 500;margin: 0 10px">${{ $product->price }}</p>
                            <button class="btn cart" data-id="{{ $product->id }}"><i
                                    class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="heart">
                        <span style="color: white">{{ $product->count_wish_list }}</span>
                        <i class="fas fa-heart" style="color: red"></i>
                    </div>
                </div>
            @empty
                <h1>No Product WishList User</h1>
            @endforelse
        </div>
    </div>

    <div class="m-4">
        <div class="my-5 text-center">
            <h3>you may also like</h3>
        </div>

        <div class="products">
            @foreach ($productCategories ?? $products as $productCategory)
                <div class="product">
                    <div class="product-image text-center">
                        <img src="{{ $productCategory->img_path }}" alt="">
                        @if (in_array($productCategory->id, $productIdsInWishlist))
                            <i class="fas fa-heart wishList text-danger" data-id="{{ $product->id }}"></i>
                        @else
                            <i class="fas fa-heart wishList" data-id="{{ $productCategory->id }}"></i>
                        @endif
                    </div>
                    <div class="product-title">
                        <a href="{{ route('product', $productCategory->id) }}">{{ $productCategory->name }}</a>
                    </div>
                    <div class="product-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($productCategory->rate >= $i)
                                        <i class="fas fa-star mx-sm-1 text-warning"></i>
                                    @else
                                        <i class="fas fa-star mx-sm-1"></i>
                                    @endif
                                @endfor
                            </div>
                            <div>
                                <span>{{ $productCategory->sold }} sold</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-size: 20px;font-weight: 500;margin: 0 10px">${{ $productCategory->price }}</p>
                            <button class="btn cart" data-id="{{ $productCategory->id }}"><i
                                    class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $productCategories ? $productCategories->links() : '' }}
        </div>
    </div>
@endsection
