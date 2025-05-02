@extends('admins.master')

@section('title', 'Categories')


@section('css')
    <style>
        .wrapper-delete {
            position: relative;
        }

        .wrapper-delete span {
            position: absolute;
            height: 20px;
            width: 20px;
            top: 5px;
            right: 5px;
            color: white;
            font-weight: bold;
            font-size: 13px;
            border-radius: 50%;
            background-color: rgb(189, 92, 92);
            /* visibility: hidden; */
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            text-align: center;
        }

        .wrapper-delete:hover {
            opacity: .8;
        }

        .wrapper-delete:hover span {
            display: inline;
            opacity: 1;
            /* visibility: visible */
        }

        .image:hover {
            opacity: 0.8;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>
        <div class="btn-group">
            @if (has_permission('admin.category.index'))
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary">All Categories</a>
            @endif
        </div>
    </div>

    <form action="{{ route('admin.category.update', @$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admins.categories._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection

@section('js')

@endsection
