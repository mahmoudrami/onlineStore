<!DOCTYPE html>
<html>

    <head>
        <title>Welcome Supplier</title>
    </head>

    <body>
        <h2>Welcome, {{ $data['name'] }}!</h2>

        <p>We are excited to have you on board as a supplier on our platform.</p>

        <p><strong>Your Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Login Link:</strong> <a href="{{ route('supplier.login') }}">{{ route('supplier.login') }}</a></p>

        <p>If you have any questions, feel free to contact us.</p>

        <p>Thank you!</p>
    </body>

</html>
