@extends('admins.master')

@section('title', 'Products')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Product</h1>
        <div class="btn-group">
            {{-- @if (has_permission('admin.product.create')) --}}
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">All Products</a>
            {{-- @endif --}}
        </div>
    </div>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.products._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
