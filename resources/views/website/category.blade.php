@extends('website.layout')

@push('css')
    <style>
        .color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: 5px;
        }

        /* hide all input radio  */
        .colors .radioColor {
            display: none;
        }

        .color.selected {
            background-color: #f1c40f !important;
            border: 1px solid gray;
        }
    </style>
@endpush

@section('content')
    @include('includes.buttonCategory')
    <div class="d-flex">
        <form action="{{ route('category', $category_id) }}" method="get">
            <div class="filter mx-3 p-3" style="width: 240px">
                <div>
                    <h3>Filter</h3>
                    <hr>
                </div>
                @foreach ($attributes as $attribute)
                    <div class="filter-card my-3">
                        <div class="filter-title">
                            {{-- @dd($attribute->values) --}}
                            <h5>{{ $attribute->name }}
                                ({{ count($attribute->values()->whereTranslation('locale', 'en')->get()) }})
                            </h5>
                        </div>
                        <div class="filter-body colors">
                            <div class="row">
                                @foreach ($attribute->values()->whereTranslation('locale', 'en')->get() as $value)
                                    @if ($attribute->name == 'Color')
                                        <div class="col-lg-6 form-check">
                                            <input type="radio" name="{{ $attribute->name }}" @checked(request()->query($attribute->name) == $value->value)
                                                value="{{ $value->value }}" class="radioColor" id="{{ $value->value }}">
                                            <label for="{{ $value->value }}">
                                                <div class="color {{ request()->query($attribute->name) == $value->value ? 'selected' : '' }}"
                                                    data-color="{{ $value->value }}"
                                                    style="background-color: {{ $value->value }}"></div>
                                            </label>
                                        </div>
                                    @else
                                        <div class="col-lg-6 form-check">
                                            <input name="{{ $attribute->name }}" @checked(request()->query($attribute->name) == $value->value)
                                                value="{{ $value->value }}" id="{{ $value->value }}" type="radio">
                                            <label for="{{ $value->value }}">{{ $value->value }}</label>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="filter-card my-3">
                    <div class="filter-title">
                        {{-- @dd($attribute->values) --}}
                        <button class="btn w-100" style="background-color: var(--mainColor);color: white">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="products-category">
            @foreach ($productsCategory as $product)
                <div class="product">
                    <div class="product-image text-center">
                        <a href="{{ route('product', $product->id) }}">
                            <img src="{{ $product->img_path }}" alt="{{ $product->name }}">
                        </a>
                        @if (Auth::check())
                            @if (in_array($product->id, $productIdsInWishlist))
                                <i class="fas fa-heart wishList text-danger" data-id="{{ $product->id }}"></i>
                            @else
                                <i class="fas fa-heart wishList" data-id="{{ $product->id }}"></i>
                            @endif
                        @endif
                    </div>
                    <div class="product-title">
                        <a href="{{ route('product', $product->id) }}">{{ $product->name }}</a>
                    </div>
                    <div class="product-body">
                        <div class="d-flex justify-content-between">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($product->rate <= $i)
                                    <i class="fas fa-star mx-sm-1"></i>
                                @else
                                    <i class="fas fa-star mx-sm-1 text-warning"></i>
                                @endif
                            @endfor
                            <span>{{ $product->sold }} sold</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p style="font-size: 20px;font-weight: 500;margin: 0 10px">${{ $product->price }}</p>
                            <button class="btn cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="pagination">
        {{-- {{ $productsCategory->links() }} --}}
    </div>
@endsection

@push('script')
    <script>
        const colors = document.querySelectorAll('.colors .color');
        colors.forEach(el => {
            el.onclick = () => {
                let isSelected = el.classList.contains('selected')
                if (!isSelected) {
                    colors.forEach(ele => {
                        ele.classList.remove('selected');
                    });
                    el.classList.add('selected');
                } else {
                    el.classList.remove('selected');
                }
            }
        });
    </script>
@endpush
