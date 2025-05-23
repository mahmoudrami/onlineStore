<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.input type="text" name="name_{{ $locale }}"
                label="Enter Name {{ __('translate.' . $locale) }} Attribute"
                hint="Enter Name {{ __('translate.' . $locale) }} Attribute..."
                oldVal="{{ isset($attribute) ? $attribute->translate($locale)->name : '' }}"></x-form.input>
        </div>
    @endforeach
</div>
