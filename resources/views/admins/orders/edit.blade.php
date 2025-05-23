@extends('admins.master')

@section('title', 'Orders')

@section('breadcrumb')
    <a href="{{ route('admin.order.index') }}">Orders</a> <span>/</span>
    <a href="{{ route('admin.order.edit', @$order->id) }}">Edit</a>
@endsection
@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Order</h1>
        <div class="btn-group">
            @if (has_permission('admin.order.index'))
                <a href="{{ route('admin.order.index') }}" class="btn btn-primary">All Orders</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.order.update', @$order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.orders._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
