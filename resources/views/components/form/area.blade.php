@props(['name' => '', 'label' => '', 'type' => '', 'hint' => '', 'oldVal' => ''])
<div class="mb-3">
    <label for="{{ $name }}">{{ $label }}</label>

    <textarea rows="5" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
        placeholder="{{ $hint }}" {{ $attributes }}>{{ old($name, $oldVal) }}</textarea>
    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
