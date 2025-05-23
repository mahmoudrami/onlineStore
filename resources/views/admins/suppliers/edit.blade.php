@extends('admins.master')

@section('title', 'Suppliers')


@section('breadcrumb')
    <a href="{{ route('admin.supplier.index') }}">Suppliers</a> <span>/</span>
    <a href="{{ route('admin.supplier.edit', @$supplier->id) }}">Edit</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Supplier</h1>
        <div class="btn-group">
            @if (has_permission('admin.supplier.index'))
                <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">All Suppliers</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.supplier.update', @$supplier->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.suppliers._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
