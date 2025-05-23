@extends('admins.master')

@section('title', 'Coupons')

@section('breadcrumb')
    <a href="{{ route('admin.coupon.index') }}">Coupons</a> <span>/</span>
    <a href="{{ route('admin.coupon.edit', @$coupon->id) }}">Edit</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Coupon</h1>
        <div class="btn-group">
            @if (has_permission('admin.coupon.index'))
                <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary">All Coupons</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.coupon.update', @$coupon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.coupons._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
