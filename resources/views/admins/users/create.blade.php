@extends('admins.master')

@section('title', 'Users')



@section('breadcrumb')
    <a href="{{ route('admin.user.index') }}">Users</a> <span>/</span>
    <a href="{{ route('admin.user.index') }}">User</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New User</h1>
        <div class="btn-group">
            @if (has_permission('admin.user.index'))
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary">All Users</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.users._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
