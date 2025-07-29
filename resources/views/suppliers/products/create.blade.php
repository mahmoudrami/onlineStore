@extends('suppliers.master')

@section('title', 'Products')


@section('breadcrumb')
    <a href="{{ route('supplier.product.index') }}">Products</a> <span>/</span>
    <a href="{{ route('supplier.product.create') }}">Create</a>
@endsection

@section('css')

@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Add New Product</h1>
        <div class="btn-group">
            <a href="{{ route('supplier.product.index') }}" class="btn btn-primary">All Products</a>
        </div>
    </div>

    <form action="{{ route('supplier.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('suppliers.products._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection
@section('js')
    <script>
        let checkBox = document.querySelectorAll('.form-checkbox');
        checkBox.forEach(el => {
            el.addEventListener('change', function() {
                let attributeId = this.id.split('-')[1];
                if (this.checked) {
                    document.querySelector(`#tableAttribute-${attributeId}`).classList.remove('d-none');
                } else {
                    document.querySelector(`#tableAttribute-${attributeId}`).classList.add('d-none');
                }
            })
        });

        document.querySelectorAll('.form-checkbox:checked').forEach(el => {

            let attributeId = el.id.split('-')[1];
            if (el.value === 'on') {
                document.querySelector(`#tableAttribute-${attributeId}`).classList.remove('d-none');
            } else {
                document.querySelector(`#tableAttribute-${attributeId}`).classList.add('d-none');
            }
        })


        function addRow(e) {
            e.preventDefault();
            let tbody = e.target.closest('div').querySelector('table tbody');
            let newRow = e.target.closest('div').querySelector('table tbody tr').cloneNode(true);
            newRow.querySelectorAll('input').forEach(el => {
                el.value = ''
            })

            tbody.appendChild(newRow);
        }

        function deleteRow(e) {
            e.preventDefault();
            e.target.closest('tr').remove();
        }
    </script>
@endsection
