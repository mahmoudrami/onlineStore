<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="name" label="Enter Name Admin" hint="Enter Name Admin..."
            oldVal="{{ @$admin->name }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="text" name="mobile" label="Enter Mobile Admin" hint="Enter Mobile Admin..."
            oldVal="{{ @$admin->mobile }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.input type="email" name="email" label="Enter Email Admin" hint="Enter Email Admin..."
            oldVal="{{ @$admin->email }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <x-form.select name="role_id" label="Enter Role Admin" hint="Select Role Admin..."
            oldVal="{{ @$admin->role_id }}" :items=$roles></x-form.select>
    </div>
</div>

@if (!isset($admin))
    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password" label="Enter Password Admin"
                hint="Enter Password Admin..."></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <x-form.input type="password" name="password_confirmation" label="Enter Password Admin Again"
                hint="Enter Name Admin..."></x-form.input>
        </div>
    </div>
@endif
