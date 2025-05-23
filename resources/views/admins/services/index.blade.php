@extends('admins.master')

@section('title', 'Services')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Services</h1>
        <div class="btn-group">
            @if (has_permission('admin.service.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Service" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.service.edit'))
                <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                    Active</button>
                <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                    disabled>Active</button>
            @endif

            @if (has_permission('admin.service.create'))
                <a href="{{ route('admin.service.create') }}" class="btn btn-primary">Add New</a>
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
            @forelse ($services as $service)
                <tr>
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $service->id }}"></td>
                    <td>{{ $service->id }}</td>
                    <td><img src="{{ $service->img_path }}" width="150px" alt="{{ $service->name }}"></td>
                    <td>{{ $service->name }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $service->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $service->id }}">
                            {{ $service->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST" class="d-inline">
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
    {{ $services->links() }}
@endsection

@section('js')

@endsection
