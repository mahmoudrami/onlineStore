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
            <div>
                <a href="{{ route('bank', ['bank_id' => $_GET['bank_id']]) }}" class="btn btn-info">Back Home</a>
            </div>
            <div class="d-flex justify-content-between my-3">
                <h3>
                    المصاري الي سلمتهم ل {{ $bank->user->name }}
                </h3>

                <div>
                    <button class="btn btn-secondary">المبلغ
                        الي اخدتو: {{ $bank->sum }}</button>
                    <button class="btn btn-secondary">المبلغ
                        المتبقي : {{ $bank->residual }}</button>

                    <button class="btn btn-secondary">المبلغ بعد
                        النسبة : {{ $bank->amount_after_apply_percentage }}</button>
                    <a href="{{ route('formAddMoney', ['bank_id' => $_GET['bank_id']]) }}"
                        class="btn btn-success">اضافة</a>
                </div>
            </div>
            <div>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>المبلغ</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monies as $money)
                            <tr>
                                <td>
                                    {{ $money->created_at->format('Y-m-d') }}
                                </td>

                                <td>{{ $money->amount }}</td>

                                <td>
                                    <a href="{{ route('formEditMoney', ['id' => $money->id, 'bank_id' => $_GET['bank_id']]) }}"
                                        class="btn btn-success">تعديل</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    </body>

</html>
