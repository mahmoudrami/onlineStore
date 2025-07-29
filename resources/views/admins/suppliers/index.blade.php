@extends('admins.master')

@section('title', 'Suppliers')

@section('breadcrumb')
    <a href="{{ route('admin.supplier.index') }}">Suppliers</a> <span>/</span>
@endsection
@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Suppliers</h1>
        <div class="btn-group">
            @if (has_permission('admin.supplier.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Supplier" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.supplier.edit'))
                <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                    Active</button>
                <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                    disabled>Active</button>
            @endif

            @if (has_permission('admin.supplier.create'))
                <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">Add New</a>
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
                <th>status</th>
                <th>actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($suppliers as $supplier)
                <tr id="tr-{{ $supplier->id }}">
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $supplier->id }}"></td>
                    <td>{{ $supplier->id }}</td>
                    <td><img src="{{ $supplier->img_path }}" width="100px" alt="{{ $supplier->name }}"></td>
                    <td>{{ $supplier->name }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $supplier->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $supplier->id }}">
                            {{ $supplier->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST"
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
                    <td colspan="6" class="text-center">Not Data Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $suppliers->links() }}
@endsection

@section('js')

@endsection
