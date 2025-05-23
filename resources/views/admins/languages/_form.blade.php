<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="code" label="Enter Code Language" hint="Enter Code Language..."
            oldVal="{{ @$language->code }}"></x-form.input>
    </div>
</div>
<div class="row">
    @foreach ($locales as $locale)
        {{-- @dump($locale) --}}
        <div class="col-6">
            <x-form.input type="text" name="name_{{ $locale }}"
                label="Enter Name {{ $locale == 'ar' ? 'Arabic' : 'English' }} Language"
                hint="Enter Name {{ $locale == 'ar' ? 'Arabic' : 'English' }} Language..."
                oldVal="{{ isset($language) ? $language->translate($locale)->name : '' }}"></x-form.input>
        </div>
    @endforeach


</div>
