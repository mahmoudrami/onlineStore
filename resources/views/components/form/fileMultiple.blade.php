@props(['name' => '', 'label' => '', 'hint' => '', 'oldVal' => []])

<div class="mb-3">
    <div><label for="{{ $name }}">{{ $label }}</label></div>


    @if (empty($oldVal))
        <input type="file" id="{{ $name }}" name="{{ $name }}" onchange="showImage(event)"
            class="form-control d-none @error($name) is-invalid @enderror" placeholder="{{ $hint }}" multiple>
        <label for="{{ $name }}"><img class="img-thumbnail prevImage" src="{{ asset('images/uploadImage.png') }}"
                alt="Upload Image" width="350px" style="object-fit: cover"></label>
    @else
        <input type="file" id="{{ $name }}" name="{{ $name }}" onchange="showImages(event)"
            class="form-control  d-none @error($name) is-invalid @enderror" placeholder="{{ $hint }}" multiple>
        <div class="d-flex gallery" style="height: 150px" id="gallery">
            @foreach ($oldVal->gallery as $one)
                <div class="wrapper-delete">
                    <span onclick="deleteImg(event,{{ $one->id }})">X</span>
                    <label for="{{ $name }}"><img class="img-thumbnail prevImage" width="150px"
                            src="{{ asset('images/products/' . @$one->path) }}" alt="Upload Image" width="350px"
                            class="gallery" style="object-fit: cover"></label>
                </div>
            @endforeach
        </div>
    @endif

    @error($name)
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
