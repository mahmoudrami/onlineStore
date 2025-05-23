@extends('suppliers.master')

@section('title', 'Reviews')


@section('breadcrumb')
    <a href="{{ route('supplier.review.index') }}">Reviews</a> <span>/</span>
    <a href="{{ route('supplier.review.edit', @$review->id) }}">Edit</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Review</h1>
        <div class="btn-group">
            @if (has_permission('supplier.review.index'))
                <a href="{{ route('supplier.review.index') }}" class="btn btn-primary">All Reviews</a>
            @endif
        </div>
    </div>

    <form action="{{ route('supplier.review.update', @$review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('suppliers.reviews._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
