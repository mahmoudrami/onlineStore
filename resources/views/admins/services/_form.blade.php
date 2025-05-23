<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.input type="text" name="name_{{ $locale }}"
                label="Enter Name {{ __('translate.' . $locale) }} Service"
                hint="Enter Name {{ __('translate.' . $locale) }} Service..."
                oldVal="{{ isset($service) ? $service->translate($locale)->name : '' }}"></x-form.input>
        </div>
    @endforeach
</div>

<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.area name="description_{{ $locale }}"
                label="Enter Name {{ __('translate.' . $locale) }} Service"
                hint="Enter Name {{ __('translate.' . $locale) }} Service..."
                oldVal="{{ isset($service) ? $service->translate($locale)->name : '' }}"></x-form.area>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-6">
        <x-form.file name='image' label="Select Image Service"></x-form.file>
    </div>
</div>
