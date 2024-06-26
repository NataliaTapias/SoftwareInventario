<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quimint')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            padding: 20px;
            overflow-y: auto;
            transition: width 0.3s;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .sidebar .logo img {
            max-width: 100px;
            height: auto;
            border-radius: 50%;
            background-color: #4CAF50; /* Color verde césped */
            padding: 10px;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .logout-button {
            background-color: #dc3545;
            border: none;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .nav-item {
            margin-bottom: 10px;
        }
        .nav-item:last-child {
            margin-bottom: 0;
        }
        .nav-link i {
            margin-right: 10px;
        }
        .nav-link i.fa {
            color: #4CAF50; /* Color verde para los iconos */
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }

        /* Estilos para la barra de desplazamiento */
    ::-webkit-scrollbar {
        width: 8px; /* Ancho de la barra de desplazamiento */
        
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1; /* Color del fondo del track */
        border-radius: 5px; /* Radio de borde del track */
        
    }

    /* Thumb (scrollbar) */
    ::-webkit-scrollbar-thumb {
        
        background: #4CAF50; /* Color del scrollbar */
        border-radius: 5px; /* Radio de borde del scrollbar */
    }

    /* Cambio de color al pasar el ratón */
    ::-webkit-scrollbar-thumb:hover {
        background: #555; /* Color del scrollbar al pasar el ratón */
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a class="nav-link" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <h2>Admin Panel</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt fa"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="fas fa-box fa"></i> Inventario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categorias.index') }}">
                    <i class="fas fa-tags fa"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('subcategorias.index') }}">
                    <i class="fas fa-layer-group fa"></i> Subcategorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('movimientos.index') }}">
                    <i class="fas fa-exchange-alt fa"></i> Movimientos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.index') }}">
                    <i class="fas fa-envelope fa"></i> Solicitudes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('estados.index') }}">
                    <i class="fas fa-flag fa"></i> Estados
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-user fa"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-user-tag fa"></i> Roles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes_has_trabajadores.index') }}">
                    <i class="fas fa-user-friends fa"></i> Solicitudes has Trabajadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trabajadores.index') }}">
                    <i class="fas fa-users fa"></i> Trabajadores
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('tipoMantenimiento.index') }}">
                    <i class="fas fa-tools fa"></i> Tipo de Mantenimiento
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tipomovimientos.index') }}">
                    <i class="fas fa-tools fa"></i> Tipo de Movimientos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link logout-button" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt fa"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
