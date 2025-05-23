@extends('admins.master')

@section('title', 'Languages')


@section('breadcrumb')
    <a href="{{ route('admin.language.index') }}">Languages</a> <span>/</span>
    <a href="{{ route('admin.language.edit', @$language->id) }}">Edit</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Language</h1>
        <div class="btn-group">
            @if (has_permission('admin.language.index'))
                <a href="{{ route('admin.language.index') }}" class="btn btn-primary">All Languages</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.language.update', @$language->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.languages._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
