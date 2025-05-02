@props(['name' => '', 'label' => '', 'hint' => '', 'oldVal' => ''])
<div class="mb-3">
    <div><label for="{{ $name }}">{{ $label }}</label></div>


    @if (empty($oldVal))
        <input type="file" id="{{ $name }}" name="{{ $name }}" onchange="showImage(event)"
            class="form-control d-none @error($name) is-invalid @enderror" placeholder="{{ $hint }}"
            {{ $attributes }}>
        <label for="{{ $name }}"><img class="img-thumbnail" src="{{ asset('images/uploadImage.png') }}"
                id="prevImage" alt="Upload Image" width="150px" style="object-fit: cover"></label>
    @else
        <input type="file" id="{{ $name }}" name="{{ $name }}" onchange="showImage(event)"
            class="form-control d-none @error($name) is-invalid @enderror" placeholder="{{ $hint }}"
            {{ $attributes }}>
        <label for="{{ $name }}" class="image"><img class="img-thumbnail" width="150px"
                src="{{ $oldVal }}" id="prevImage" alt="Upload Image" style="object-fit: cover"></label>
    @endif

    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
