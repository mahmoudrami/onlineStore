@props(['name' => '', 'label' => '', 'type' => '', 'hint' => '', 'oldVal' => ''])
<div class="mb-3">
    <label for="{{ $name }}">{{ $label }}</label>

    <input type="{{ $type }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
        placeholder="{{ $hint }}" value="{{ old($name, $oldVal) }}" {{ $attributes }}>
    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
