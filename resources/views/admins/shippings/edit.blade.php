@extends('admins.master')

@section('title', 'Shippings')

@section('breadcrumb')
    <a href="{{ route('admin.shipping.index') }}">Shippings</a> <span>/</span>
    <a href="{{ route('admin.shipping.edit', @$shipping->id) }}">Edit</a>
@endsection
@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Attribute</h1>
        <div class="btn-group">
            @if (has_permission('admin.shipping.index'))
                <a href="{{ route('admin.shipping.index') }}" class="btn btn-primary">All Shippings</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.shipping.update', @$shipping->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.shippings._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
