

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
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a class="nav-link" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <h2>Admin Panel</h2>
        <div class="user-info">
           
        @if(Auth::check())
                <p>Bienvenido, {{ Auth::user()->nombre }}</p>
            @else
                <p>No estás autenticado</p>
            @endif
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="fas fa-tachometer-alt fa"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    <i class="fas fa-box fa"></i> Inventario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categorias.index') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                    <i class="fas fa-tags fa"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('areas.index') ? 'active' : '' }}" href="{{ route('areas.index') }}">
                    <i class="fas fa-tags fa"></i> Areas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('subcategorias.index') ? 'active' : '' }}" href="{{ route('subcategorias.index') }}">
                    <i class="fas fa-layer-group fa"></i> Subcategorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('movimientos.index') ? 'active' : '' }}" href="{{ route('movimientos.index') }}">
                    <i class="fas fa-exchange-alt fa"></i> Movimientos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('solicitudes.index') ? 'active' : '' }}" href="{{ route('solicitudes.index') }}">
                    <i class="fas fa-envelope fa"></i> Solicitudes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('estados.index') ? 'active' : '' }}" href="{{ route('estados.index') }}">
                    <i class="fas fa-flag fa"></i> Estados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-user fa"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                    <i class="fas fa-user-tag fa"></i> Roles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('solicitudes_has_trabajadores.index') ? 'active' : '' }}" href="{{ route('solicitudes_has_trabajadores.index') }}">
                    <i class="fas fa-user-friends fa"></i> Solicitudes has Trabajadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('trabajadores.index') ? 'active' : '' }}" href="{{ route('trabajadores.index') }}">
                    <i class="fas fa-users fa"></i> Trabajadores
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tipoMantenimiento.index') ? 'active' : '' }}" href="{{ route('tipoMantenimiento.index') }}">
                    <i class="fas fa-tools fa"></i> Tipo de Mantenimiento
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tipomovimientos.index') ? 'active' : '' }}" href="{{ route('tipomovimientos.index') }}">
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
