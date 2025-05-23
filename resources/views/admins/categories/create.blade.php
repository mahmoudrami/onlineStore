@extends('admins.master')

@section('title', 'Categories')


@section('breadcrumb')
    <a href="{{ route('admin.category.index') }}">Categories</a> <span>/</span>
    <a href="{{ route('admin.category.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
        <div class="btn-group">
            @if (has_permission('admin.category.index'))
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary">All Categories</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.categories._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
