@props(['name' => '', 'label' => '', 'hint' => '', 'oldVal' => '', 'items' => []])

<div class="mb-3">
    <div><label for="{{ $name }}">{{ $label }}</label></div>

    <select name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
        <option value="">{{ $hint }}</option>
        @foreach ($items as $item)
            <option value="{{ $item->id }}" @selected($item->id == $oldVal || old($name))>{{ $item->name }}</option>
        @endforeach
    </select>

    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
