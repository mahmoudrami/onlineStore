<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.input type="text" name="name_{{ $locale }}"
                label="Enter Name {{ __('translate.' . $locale) }} Category"
                hint="Enter Name {{ __('translate.' . $locale) }} Category..."
                oldVal="{{ isset($category) ? $category->translate($locale)->name : '' }}"></x-form.input>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-6">
        <x-form.file name='image' label="Select Image Category"></x-form.file>
    </div>
</div>
