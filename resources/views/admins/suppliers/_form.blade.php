<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="name" label="Enter Name Supplier" hint="Enter Name Supplier..."
            oldVal="{{ @$supplier->name }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="mobile" label="Enter Mobile Supplier" hint="Enter Mobile Supplier..."
            oldVal="{{ @$supplier->mobile }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="email" name="email" label="Enter Email Supplier" hint="Enter Email Supplier..."
            oldVal="{{ @$supplier->email }}"></x-form.input>
    </div>
</div>

@if (!isset($supplier))
    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password" label="Enter Password Supplier"
                hint="Enter Password Supplier..."></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password_confirmation" label="Enter Password Supplier Again"
                hint="Enter Name Supplier..."></x-form.input>
        </div>
    </div>
@endif

<x-form.file name="image" oldVal="{{ @$supplier->img_path }}" label="Select Image Supplier"></x-form.file>
