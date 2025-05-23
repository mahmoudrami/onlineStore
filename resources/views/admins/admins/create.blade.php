@extends('admins.master')

@section('title', 'Admins')


@section('breadcrumb')
    <a href="{{ route('admin.admin.index') }}">Admins</a> <span>/</span>
    <a href="{{ route('admin.admin.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Admin</h1>
        <div class="btn-group">
            @if (has_permission('admin.admin.index'))
                <a href="{{ route('admin.admin.index') }}" class="btn btn-primary">All Admins</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.admins._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
