<!DOCTYPE html>
<html>

<head>
    <title>Bienvenido a {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
            line-height: 1.5;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Bienvenido, {{ $user->first_name }} {{ $user->last_name }}!</h1>
        <p>Gracias por registrarte en {{ config('app.name') }}.</p>
        <p>Tu correo: {{ $user->email }}</p>
        <p>Ahora puedes disfrutar de todos nuestros servicios.</p>
        <p>Saludos cordiales,<br>El equipo de {{ config('app.name') }}</p>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>

</html>