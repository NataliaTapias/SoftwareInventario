<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
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
            transition: width 0.3s;
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('items.index') }}">
                    <i class="fas fa-box"></i> Inventario
                </a>
            </li>
            <!-- Nuevos elementos de navegación -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('areas.index') }}">
                    <i class="fas fa-th-large"></i> Áreas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categorias.index') }}">
                    <i class="fas fa-tags"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('estados.index') }}">
                    <i class="fas fa-flag"></i> Estados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('movimientos.index') }}">
                    <i class="fas fa-exchange-alt"></i> Movimientos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-user-tag"></i> Roles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.index') }}">
                    <i class="fas fa-envelope"></i> Solicitudes
                </a>
            </li>
            <li class="nav-item">
             <a class="nav-link" href="{{ route('solicitudes_has_trabajadores.index') }}">
              <i class="fas fa-user-friends"></i> Solicitudes has Trabajadores
            </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('subcategorias.index') }}">
                    <i class="fas fa-layer-group"></i> Subcategorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tipoMantenimiento.index') }}">
                    <i class="fas fa-tools"></i> Tipo de Mantenimiento
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('tipomovimientos.index') }}">
    <i class="fas fa-tools"></i> Tipo de Movimientos
</a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trabajadores.index') }}">
                    <i class="fas fa-users"></i> Trabajadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-user"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link logout-button" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt"></i> Logout
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
