@extends('admins.master')


@section('breadcrumb')
    <a href="{{ route('admin.role.index') }}">Roles</a> <span>/</span>
    <a href="{{ route('admin.role.create') }}">Create</a>
@endsection


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Add New Role</h1>
        <a href="{{ route('admin.role.index') }}" class="btn btn-info">All Roles</a>
    </div>
    <form action="{{ route('admin.role.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-10">
                <x-form.input name="name" hint="Enter Name..." type="text"
                    oldval="{{ @$admin->name }}"></x-form.input>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                @foreach ($permissions as $permission)
                    <div class="p-3 w-50  mb-3" style="background-color: #eee">
                        <h5>{{ $permission->name }}</h5>
                        @if (count($permission->childs) > 0)
                            <div>
                                @foreach ($permission->childs as $item)
                                    <label class="mx-4 font-bold"><input class="mx-2" type="checkbox"
                                            value="{{ $item->id }}" name="permissions[]">{{ $item->name }}</label><br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Save</button>
    </form>
@endsection
