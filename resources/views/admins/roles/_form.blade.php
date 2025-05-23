<div class="row">
    <div class="col-8">
        <x-form.input name="name" hint="Enter Name..." type="text" oldval="{{ @$admin->name }}"></x-form.input>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <x-form.input name="email" hint="Enter Email..." type="email" oldval="{{ @$admin->email }}"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <x-form.input name="password" hint="Enter Password ..." type="password"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <x-form.input name="password_confirmation" hint="Enter Password Again ..." type="password"></x-form.input>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <x-form.select name="role_id" label="Role" hint="Select Role Admin" :items=$role></x-form.select>
    </div>
</div>
