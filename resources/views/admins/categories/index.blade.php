@extends('admins.master')

@section('title', 'Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Categories</h1>
        <div class="btn-group">
            @if (has_permission('admin.category.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Category" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.category.edit'))
                <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                    Active</button>
                <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                    disabled>Active</button>
            @endif

            @if (has_permission('admin.category.create'))
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add New</a>
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
            @forelse ($categories as $category)
                <tr id="tr-{{ $category->id }}">
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $category->id }}"></td>
                    <td>{{ $category->id }}</td>
                    <td><img src="{{ $category->img_path }}" width="150px" alt="{{ $category->name }}"></td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $category->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $category->id }}">
                            {{ $category->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
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
    {{-- {{ $categories->links() }} --}}
@endsection

@section('js')

@endsection
