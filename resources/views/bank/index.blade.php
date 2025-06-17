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
            <div class="d-flex justify-content-between my-3">
                <h3>
                    المصاري الي استلمتهم من محمود رضوان
                </h3>
                <a href="{{ route('formAddBank') }}" class="btn btn-secondary">اضافة استلام مبلغ</a>
            </div>
            <div>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>المبلغ كامل</th>
                            <th>النسبة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                            <tr>
                                <td>
                                    {{ $bank->created_at->format('Y-m-d') }}
                                </td>
                                <td>{{ $bank->amount }}</td>
                                <td>{{ $bank->percentage }}%</td>
                                <td>
                                    <a href="{{ route('money', ['bank_id' => $bank->id]) }}"
                                        class="btn btn-success">التفاصيل
                                    </a>
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
