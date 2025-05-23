@extends('admins.master')

@section('title', 'Attributes')


@section('breadcrumb')
    <a href="{{ route('admin.attribute.index') }}">Attributes</a> <span>/</span>
    <a href="{{ route('admin.attribute.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
        <div class="btn-group">
            @if (has_permission('admin.attribute.index'))
                <a href="{{ route('admin.attribute.index') }}" class="btn btn-primary">All Attributes</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.attribute.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.attributes._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
