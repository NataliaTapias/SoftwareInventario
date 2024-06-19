<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            margin: 0;
            background-image: url('{{ asset('images/fondo.webp') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        .login-container .logo-container {
            text-align: center;
            margin-right: 2em; /* Espacio entre el logo y el formulario en escritorio */
        }
        .login-container .logo-container img {
            width: 150px;
        }
        .login-container .form-container {
            flex: 1;
        }
        .login-container h2 {
            margin-bottom: 1em;
            text-align: center;
        }
        .login-container .form-group {
            margin-bottom: 1em;
        }
        .login-container .form-group label {
            display: block;
            margin-bottom: 0.5em;
        }
        .login-container .form-group input {
            width: 100%;
            padding: 0.75em;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 0.75em;
            border: 5px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }

        /* Media Query para pantallas más pequeñas */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                align-items: center;
                padding: 1em;
            }
            .login-container .logo-container {
                margin-right: 0;
                margin-bottom: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="form-container">
            <h2>Bienvenido a Quimint</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
