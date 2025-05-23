<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="name" label="Enter Name Review" hint="Enter Name Review..."
            oldVal="{{ @$review->name }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="mobile" label="Enter Mobile Review" hint="Enter Mobile Review..."
            oldVal="{{ @$review->mobile }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="email" name="email" label="Enter Email Review" hint="Enter Email Review..."
            oldVal="{{ @$review->email }}"></x-form.input>
    </div>
</div>

@if (!isset($review))
    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password" label="Enter Password Review"
                hint="Enter Password Review..."></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password_confirmation" label="Enter Password Review Again"
                hint="Enter Name Review..."></x-form.input>
        </div>
    </div>
@endif

<x-form.file name="image" oldVal="{{ @$review->img_path }}" label="Select Image Review"></x-form.file>
