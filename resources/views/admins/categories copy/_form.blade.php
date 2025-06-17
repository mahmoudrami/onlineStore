<div class="row">
    @foreach ($locales as $locale)
        <div class="col-6">
            <x-form.input type="text" name="title_{{ $locale }}"
                label="Enter Title {{ __('translate.' . $locale) }} Page"
                hint="Enter Title {{ __('translate.' . $locale) }} Page..."
                oldVal="{{ isset($category) ? $category->translate($locale)->title : '' }}"></x-form.input>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-6">
        <x-form.file name='image' label="Select Image Page"></x-form.file>
    </div>
</div>
