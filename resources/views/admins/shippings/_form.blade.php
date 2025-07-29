<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.input type="text" name="city" label="Enter Name {{ __('translate.' . $locale) }} City"
                hint="Enter Name {{ __('translate.' . $locale) }} City..."
                oldVal="{{ isset($shipping) ? $shipping->translate($locale)->name : '' }}"></x-form.input>
        </div>
    @endforeach
</div>

<div class="row">

    <div class="col-6">
        <x-form.input type="text" name="price" label="Enter Price Shipping City" hint="Enter Price Shipping City"
            oldVal="{{ @$shipping->price }}"></x-form.input>
    </div>
</div>
