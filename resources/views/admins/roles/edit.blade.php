@extends('admins.master')


@section('breadcrumb')
    <a href="{{ route('admin.role.index') }}">Suppliers</a> <span>/</span>
    <a href="{{ route('admin.role.edit', @$role->id) }}">Edit</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Edit Role</h1>
        <a href="{{ route('admin.role.index') }}" class="btn btn-info">All Roles</a>
    </div>
    <form action="{{ route('admin.role.update', @$role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-10">
                <x-form.input name="name" hint="Enter Name..." type="text"
                    oldval="{{ @$role->name }}"></x-form.input>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                @foreach ($permissions as $permission)
                    @if (count($permission->childs) > 0)
                        <div class="p-3 w-50  mb-3" style="background-color: #eee">
                            <div>
                                <h5>{{ $permission->name }}</h5>
                                @foreach ($permission->childs as $item)
                                    <label class="mx-4 font-bold"><input class="mx-2" type="checkbox"
                                            value="{{ $item->id }}" name="permissions[]"
                                            @checked(in_array($item->id, $permissionsIDs))>{{ $item->name }}</label><br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
    </form>
@endsection
