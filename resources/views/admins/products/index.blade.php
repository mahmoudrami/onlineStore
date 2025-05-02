@extends('admins.master')

@section('title', 'Products')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Products</h1>
        <div class="btn-group">
            @if (has_permission('admin.product.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Category" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.product.edit'))
                <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                    Active</button>
                <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                    disabled>Active</button>
            @endif

            @if (has_permission('admin.product.create'))
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add New</a>
            @endif
        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr class="text-uppercase">
                <th><input type="checkbox" class="form-checkbox" id="checkboxall"></th>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $product->id }}"></td>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ $product->img_path }}" width="100px" alt="{{ $product->name }}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $product->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $product->id }}">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button onclick="deleteItem(event)" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan="6" class="text-center">Not Data Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection

@section('js')

@endsection
