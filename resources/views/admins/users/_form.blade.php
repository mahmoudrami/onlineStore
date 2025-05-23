<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="name" label="Enter Name User" hint="Enter Name User..."
            oldVal="{{ @$user->name }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="mobile" label="Enter Mobile User" hint="Enter Mobile User..."
            oldVal="{{ @$user->mobile }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="email" name="email" label="Enter Email User" hint="Enter Email User..."
            oldVal="{{ @$user->email }}"></x-form.input>
    </div>
</div>

@if (!isset($user))
    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password" label="Enter Password User"
                hint="Enter Password User..."></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password_confirmation" label="Enter Password User Again"
                hint="Enter Name User..."></x-form.input>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-6">
        <x-form.file name="image" label="Enter Image User"></x-form.file>
    </div>
</div>
