@extends('admins.master')

@section('title', 'Coupons')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Coupons</h1>
        <div class="btn-group">
            @if (has_permission('admin.coupon.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Coupon" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.coupon.edit'))
                <button data-bs-toggle="modal" data-bs-target="#NotActiveModal" disabled class="btn btn-secondary event">Not
                    Active</button>
                <button class="btn btn-dark event" data-bs-toggle="modal" disabled data-bs-target="#ActiveModal"
                    disabled>Active</button>
            @endif

            @if (has_permission('admin.coupon.create'))
                <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">Add New</a>
            @endif
        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr class="text-uppercase">
                <th><input type="checkbox" class="form-checkbox" id="checkboxall"></th>

                <th>id</th>
                <th>code</th>
                <th>date start</th>
                <th>date end</th>
                <th>usage limit</th>
                <th>status</th>
                <th>actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($coupons as $coupon)
                <tr>
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $coupon->id }}"></td>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->start_date }}</td>
                    <td>{{ $coupon->end_date }}</td>
                    <td>{{ $coupon->usage_limit }}</td>
                    <td>
                        <span style="font-size: 12px;padding: 8px;"
                            class="btn  {{ $coupon->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                            id="label-{{ $coupon->id }}">
                            {{ $coupon->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" class="d-inline">
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
    {{ $coupons->links() }}
@endsection

@section('js')

@endsection
