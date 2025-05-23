@extends('suppliers.master')

@section('title', 'Products')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Products</h1>
        <div class="btn-group">

            <button class="btn btn-danger event" disabled id="delete-items" data-model="Category" data-bs-toggle="modal"
                disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>


            <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                Active</button>
            <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                disabled>Active</button>



            <a href="{{ route('supplier.product.create') }}" class="btn btn-primary">Add New</a>

        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr class="text-uppercase">
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
                        <a href="{{ route('supplier.product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('supplier.product.destroy', $product->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('delete')
                            <button onclick="deleteItem(event)" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan="8" class="text-center">Not Data Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->links() }}
@endsection

@section('js')

@endsection
