<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido al Dashboard</h1>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>
