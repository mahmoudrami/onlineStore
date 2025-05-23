@extends('admins.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">All Admin</h1>
        @if (has_permission('admin.role.create'))
            <div class="btn-group">
                @if (has_permission('admin.role.delete'))
                    <button class="btn btn-danger event" disabled id="delete-items" data-model="Category" data-bs-toggle="modal"
                        disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
                @endif
                @if (has_permission('admin.role.edit'))
                    <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled
                        class="btn btn-secondary event">Not
                        Active</button>
                    <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                        disabled>Active</button>
                @endif

                @if (has_permission('admin.role.create'))
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Add New</a>
                @endif
            </div>
        @endif
    </div>

    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" class="form-checkbox" id="checkboxall"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($roles as $role)
                <tr id="tr-{{ $role->id }}">
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $role->id }}"></td>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $role->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $role->id }}">
                            {{ $role->status }}
                        </span>
                    </td>
                    <td>{{ $role->created_at->diffForHumans() }}</td>

                    <td>
                        @if (has_permission('admin.role.edit'))
                            <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fas fa-edit"></i></a>
                        @endif
                        @if (has_permission('admin.role.delete'))
                            <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button onclick="deleteItem(event)" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>


    </table>
    {{ $roles->links() }}
@endsection
