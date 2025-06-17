@extends('website.layout')

@section('title', 'WishList')

@section('content')
    <div class="wishList m-3 p-4">
        <div class="title-wishList my-3">
            <h3>MY WISHLIST (3)</h3>
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
            @foreach ($products as $product)
                <div class="wishList-item">
                    <div class="image-wishlist">
                        <img src="{{ asset('website/images/dress.jpg') }}" alt="">
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
                            <button class="btn"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                    <div class="heart">
                        <span style="color: white">{{ $product->count_wish_list }}</span>
                        <i class="fas fa-heart" style="color: red"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="m-4">
        <div class="my-5 text-center">
            <h3>you may also like</h3>
        </div>

        <div class="products">
            @foreach ($productCategories as $productCategory)
                <div class="product">
                    <div class="product-image text-center">
                        <img src="{{ asset('website/images/سماعة.jpg') }}" alt="">
                    </div>
                    <div class="product-title">
                        <p>{{ $productCategory->name }}</p>
                    </div>
                    <div class="product-body">
                        <div class="d-flex justify-content-between">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star mx-sm-1"></i>
                            @endfor
                            <span>{{ $productCategory->sold }} sold</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-size: 20px;font-weight: 500;margin: 0 10px">${{ $productCategory->price }}</p>
                            <button class="btn"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $productCategories->links() }}
        </div>
    </div>
@endsection
