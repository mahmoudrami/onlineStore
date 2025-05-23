@extends('admins.master')

@section('title', 'Services')


@section('breadcrumb')
    <a href="{{ route('admin.service.index') }}">Services</a> <span>/</span>
    <a href="{{ route('admin.service.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Service</h1>
        <div class="btn-group">
            @if (has_permission('admin.service.index'))
                <a href="{{ route('admin.service.index') }}" class="btn btn-primary">All Services</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.services._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
