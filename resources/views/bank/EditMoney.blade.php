<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">


    </head>

    <body>
        <div class="container my-5">
            <h3>
                تعديل مبلغ استلمو محمود
            </h3>
            <div>
                <form action="{{ route('editMoney', ['id' => $money->id, 'bank_id' => $_GET['bank_id']]) }}"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">المبلغ</label>
                                <input type="text" name="amount" class="form-control"
                                    value="{{ old('amount', $money->amount) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 text-center">
                                <button class="btn btn-success w-50">ارسال</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>

</html>
