@extends('website.layout')

@section('title', 'Single Product')
@section('content')
    <div class="d-flex justify-content-between mx-3 p-3">
        <div class="flex-grow-1">
            <div class="images-product">
                <div class="image-gallery">
                    @foreach ($product->gallery as $img)
                        <img src="{{ asset('images/products/' . @$img->path) }}" alt=""
                            onclick="changeImage('{{ asset('images/products/' . @$img->path) }}')">
                    @endforeach ($product->gallery as )
                </div>
                <div class="main-image flex-grow-1">
                    <img id="mainImage" src="{{ $product->img_path }}" alt="">
                </div>
            </div>
            <div class="reviews p-5 mx-2">
                <div>
                    <h1>Customer Review</h1>
                    <div class="px-5 py-4" style="background-color: #eee">
                        <div class="d-flex align-items-center">
                            <h1>{{ $product->rate }}</h1>
                            <div class="ms-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($product->rate >= $i)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="fas fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div>
                            <h4>Over Fit:</h4>
                            <div class="d-flex justify-content-between">

                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                                <div>
                                    <label for="">Small</label><br>
                                    <input type="range" value="4" disabled> <span>4%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($product->reviews) > 0)
                    <div>
                        <div class="mt-3 user-review p-3">
                            @foreach ($product->reviews as $review)
                                {{-- @dd($review) --}}
                                <div class="review-item mb-2">
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $review->user->name }} <span>{{ $review->created_at->format('d F,Y') }}</span>
                                        </p>
                                        <div>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($review->rating >= $i)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="fas fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <p id="text-to-translate-{{ $review->id }}" data-lang="{{ app()->getLocale() }}">
                                            {{ $review->comment }}</p>
                                        <p id="translated-text-{{ $review->id }}"></p>
                                        <a href="javascript::" id="translate-btn-{{ $review->id }}"
                                            onclick="translateText(event,{{ $review->id }})"
                                            style="color: blue;text-decoration: underline">Translate</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                @endif
                @if (Auth::check())
                    <div class="mt-3">
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star rate" onclick="rate({{ $i }})"></i>
                            @endfor
                        </div>
                        <form action="{{ route('review', $product->id) }}" method="post">
                            @csrf
                            <div class="mb-1">
                                <div class="">
                                    <input type="hidden" name="rating" id="rating">
                                    <input type="text" class="form-control" name="comment">
                                    <div class="mt-2 submit-form">
                                        <button class="btn">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div style="width: 650px" class="p-1">
            <p class="description" style="font-size: 19px;font-weight: 400;">
                <button class="trend">Trends</button>
                {{ $product->description }}
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>${{ $product->price }}</h4>
                </div>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($product->rate >= $i)
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @endfor
                </div>
                <div class="me-5 p-1">
                    <p class="text-warning">(+{{ $product->count_rate }} Reviews)</p>
                </div>
            </div>
            <hr>
            {{-- <div class="attributes">
                <div class="Color">
                    <div class="attribute-title">
                        <p><span style="font-weight: bold;font-size: 20px">Color:</span> Navy Blue</p>
                        <div class="attribute-body">
                            <div class="d-flex flex-wrap gap-3" style="width: 280px">
                                <div class="color-wrapper">
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: navy;padding: 5px;border: 1px solid black;box-sizing: border-box;">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #52859c;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #492d2d;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #696969;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: #215d48;padding: 5px">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: white;padding: 5px;border: 1px solid rgb(173, 171, 171)">
                                    </div>
                                </div>
                                <div>
                                    <div class="item"
                                        style="width: 40px;height: 40px; border-radius:50%;background-color: black;padding: 5px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Size mt-3">
                    <div class="attribute-title">
                        <p><span style="font-weight: bold;font-size: 20px">Size:</span> Large</p>
                        <div class="attribute-body">
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                                <button class="btn">large</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="d-flex align-items-center mt-3">
                <div style="width: 80%;text-align: center">
                    <button class="btn py-3 px-5 cart" data-id="{{ $product->id }}"
                        style="width: 70%;background-color: var(--mainColor);color: white;font-weight: bold">Add
                        To Cart</button>
                </div>
                <div>
                    <button class="btn mx-auto"><i class="fas fa-heart wishList"></i></button>
                </div>
            </div>
            <div class="my-3 p-4" style="background-color: #f4f4f4">
                <p style="font-size: 20px"><span style="font-weight: bold">Shipping to</span> Palestine</p>
                <div class="p-1">
                    @foreach ($services as $service)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('website/images/fast-delivery.png') }}" width="50px" alt="">
                            <p class="mt-3 ms-2">{{ $service->name }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-evenly">
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Safe
                        Payments</button>
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Customer
                        Service</button>
                    <button class="btn px-3" style="background-color: #f2d9d3"><span>✔️</span> Secure
                        Logistics</button>
                </div>
            </div>

            <div class="my-3 size">
                <h4>Size & Fit</h4>
                <div>
                    <button class="btn active">CM</button>
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <i class="fas fa-long-arrow-alt-right"></i>
                    <button class="btn">IN</button>
                    <div class="d-flex my-3 Size-type">
                        <p class="active">Product Measurements</p>
                        <p class="ms-4">Body Measurements</p>
                    </div>
                    <div class="my-3 table">
                        <table class="table table-bordered text-center">
                            <tr>
                                <td>Size</td>
                                <td>Shoulder</td>
                                <td>Bust</td>
                                <td>Length (L)</td>
                                <td>Sleeve (L)</td>
                                <td>Bicep (L)</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>46</td>
                                <td>108</td>
                                <td>73</td>
                                <td>62.8</td>
                                <td>40.8</td>
                            </tr>
                        </table>

                    </div>
                    <div class="p-2">
                        <li>This data was obtained from manually measuring the product, it may be off by
                            1-2
                            CM.</li>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        function changeImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;
        }
    </script>

    <script>
        function rate(rate) {
            document.querySelector('#rating').value = rate;
            document.querySelectorAll('.rate').forEach((element, index) => {
                element.classList.remove('text-warning');
            });
            document.querySelectorAll('.rate').forEach((element, index) => {
                if ((index + 1) <= rate) {
                    element.classList.add('text-warning');
                }
            });
        }

        function translateText(e, id) {
            e.preventDefault();
            let translateBtn = document.querySelectorAll('#translate-btn-' + id);
            let parentElementText = document.querySelector('#text-to-translate-' + id);
            let text = document.querySelector('#text-to-translate-' + id).textContent;
            let lang = 'ar';
            if (parentElementText.getAttribute('data-lang') == 'en') {
                lang = 'ar'
            } else {
                lang = 'en'
            }

            $.ajax({
                url: '{{ route('translate.text') }}',
                method: 'POST',
                data: {
                    text: text,
                    lang: lang,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    let translatedText = document.querySelector('#translated-text-' + id);
                    translatedText.textContent = response.translatedText;
                    document.querySelector('#text-to-translate-' + id).classList.add('d-none')
                    parentElementText.setAttribute('data-lang', lang)
                }
            });
        }
    </script>
@endpush
