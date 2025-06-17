@extends('admins.master')

@section('title', 'Pages')


@section('breadcrumb')
    <a href="{{ route('admin.page.index') }}">Pages</a> <span>/</span>
    <a href="{{ route('admin.page.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Page</h1>
        <div class="btn-group">
            @if (has_permission('admin.page.index'))
                <a href="{{ route('admin.page.index') }}" class="btn btn-primary">All Pages</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.pages._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
