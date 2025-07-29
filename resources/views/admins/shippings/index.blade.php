@extends('admins.master')

@section('title', 'Shippings')


@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">All Shippings</h1>
        <div class="btn-group">
            @if (has_permission('admin.shipping.delete'))
                <button class="btn btn-danger event" disabled id="delete-items" data-model="Shipping" data-bs-toggle="modal"
                    disabled data-bs-target="#DeleteModal">{{ __('Delete') }}</button>
            @endif
            @if (has_permission('admin.shipping.create'))
                <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary">Add New</a>
            @endif
        </div>
    </div>
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr class="text-uppercase">
                <th><input type="checkbox" class="form-checkbox" id="checkboxall"></th>

                <th>id</th>
                <th>name</th>
                <th>status</th>
                <th>actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($shippings as $shipping)
                <tr id="tr-{{ $shipping->id }}">
                    <td><input type="checkbox" name="itemsIds[]" class="chbtn" value="{{ $shipping->id }}"></td>
                    <td>{{ $shipping->id }}</td>
                    <td>{{ $shipping->city }}</td>
                    <td>{{ $shipping->price }}</td>

                    <td>
                        <a href="{{ route('admin.shipping.edit', $shipping->id) }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.shipping.destroy', $shipping->id) }}" method="POST" class="d-inline">
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
    {{ $shippings->links() }}
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("المتصفح لا يدعم تحديد الموقع.");
            }

            function showPosition(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                console.log("Latitude: " + latitude + ", Longitude: " + longitude);

                // مثال: إرسال الموقع إلى السيرفر
                fetch('/save-location', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // لو Laravel
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude
                    })
                });
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("تم رفض طلب تحديد الموقع.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("معلومات الموقع غير متوفرة.");
                        break;
                    case error.TIMEOUT:
                        alert("انتهت مهلة تحديد الموقع.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("حدث خطأ غير معروف.");
                        break;
                }
            }
        });
    </script>
@endsection
