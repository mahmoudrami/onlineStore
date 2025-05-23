@extends('admins.master')

@section('title', 'Reviews')

@section('breadcrumb')
    <a href="{{ route('admin.review.index') }}">Reviews</a> <span>/</span>
    <a href="{{ route('admin.review.create') }}">Edit</a>
@endsection
@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Review</h1>
        <div class="btn-group">
            @if (has_permission('admin.review.index'))
                <a href="{{ route('admin.review.index') }}" class="btn btn-primary">All Reviews</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.review.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admins.reviews._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
