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

<div class="row mb-3">

    <div class="col-6">
        <label for="is_multiple">Select Type Attribute</label>
        <select name="is_multiple" class="form-control" id="is_multiple">
            <option value="">Select Type Attribute</option>
            <option value="1">Yes</option>
            <option value="0">NO</option>
        </select>
    </div>

</div>
