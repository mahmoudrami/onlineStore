@extends('suppliers.master')

@section('title', 'Products')


@section('breadcrumb')
    <a href="{{ route('supplier.product.index') }}">Products</a> <span>/</span>
    <a href="{{ route('supplier.product.edit', $product->id) }}">Edit</a>
@endsection

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
        <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>
        <div class="btn-group">
            <a href="{{ route('supplier.product.index') }}" class="btn btn-primary">All Products</a>
        </div>
    </div>

    <form action="{{ route('supplier.product.update', @$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('suppliers.products._form')
        <button class="btn btn-success"><i class="fas fa-save"></i> save</button>
    </form>
@endsection


@section('js')
    <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
    <script>
        function deleteImg(e, id) {

            if (id == 0) {
                e.target.parentElement.remove();

            } else {
                url = "{{ route('admin.product.delete_image') }}";
                axios
                    .post(url + '/' + id)
                    .then(function(response) {
                        e.target.parentElement.remove();
                        console.log('success');
                    })
                    .catch(function(error) {
                        console.log('error');
                    })
            }

        }
    </script>



    <script>
        function deleteRow(event) {
            event.preventDefault();
            event.target.closest('tr').remove();
        }

        function addRow(attributeName) {
            const slug = attributeName.toLowerCase().replace(/ /g, '-');
            const tbody = document.getElementById('rows_' + slug);
            const locales = @json($locales);

            let row = document.createElement('tr');
            let cells = '';

            locales.forEach(locale => {
                cells += `
                    <td><input type="text" name="attributeValue[${attributeName}][${locale}][]" class="form-control"></td>
                `;
            });

            cells += `<td><button type="button" onclick="deleteRow(event)" class="btn btn-sm btn-danger">X</button></td>`;
            row.innerHTML = cells;
            tbody.appendChild(row);
        }

        function toggleAttributeTable(slug) {
            const checkbox = document.getElementById('check_' + slug);
            const tableDiv = document.getElementById('table_' + slug);
            tableDiv.style.display = checkbox.checked ? 'block' : 'none';
        }
    </script>

@endsection
