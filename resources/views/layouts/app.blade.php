<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <h2>{{ Auth::user()->cargo }}</h2>
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
                <a class="nav-link {{ request()->routeIs('informes.index') ? 'active' : '' }}" href="{{ route('informes.index') }}">
                <i class="fas fa-file-alt fa"></i> Informes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    <i class="fas fa-box fa"></i> Inventario
                </a>
            </li>
            @if (!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))

            @endif
            @if (!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('estados.index') ? 'active' : '' }}" href="{{ route('estados.index') }}">
                    <i class="fas fa-flag fa"></i> Estados
                </a>
            </li>
            @endif
            @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-user fa"></i> Usuarios
                </a>
            </li>
            @endif
            @if (!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                    <i class="fas fa-user-tag fa"></i> Roles
                </a>
            </li>
            @endif

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
                <a class="nav-link {{ request()->routeIs('trabajadores.index') ? 'active' : '' }}" href="{{ route('trabajadores.index') }}">
                    <i class="fas fa-users fa"></i> Trabajadores
                </a>
            </li>

            @if (!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tipomantenimientos.index') ? 'active' : '' }}" href="{{ route('tipomantenimientos.index') }}">
                    <i class="fas fa-tools fa"></i> Tipo de Mantenimiento
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tipomovimientos.index') ? 'active' : '' }}" href="{{ route('tipomovimientos.index') }}">
                    <i class="fas fa-tools fa"></i> Tipo de Movimientos
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('areas.index') ? 'active' : '' }}" href="{{ route('areas.index') }}">
                    <i class="fas fa-tags fa"></i> Areas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categorias.index') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                    <i class="fas fa-tags fa"></i> Categorías
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('subcategorias.index') ? 'active' : '' }}" href="{{ route('subcategorias.index') }}">
                    <i class="fas fa-layer-group fa"></i> Subcategorías
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const itemInput = document.getElementById('item-search');
    const itemResultsContainer = document.getElementById('results-container');

    const solicitudInput = document.getElementById('solicitud-search');
    const solicitudResultsContainer = document.getElementById('solicitud-results-container');

    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precio');
    const totalInput = document.getElementById('total');

    function updateTotal() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        totalInput.value = (cantidad * precio).toFixed(2);
    }

    cantidadInput.addEventListener('input', updateTotal);
    precioInput.addEventListener('input', updateTotal);

    itemInput.addEventListener('input', function () {
        const query = itemInput.value;

        if (query.length > 1) {
            fetch(`/items/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    itemResultsContainer.innerHTML = '';
                    if (data.length === 0) {
                        const div = document.createElement('div');
                        div.textContent = 'No se encontraron resultados';
                        itemResultsContainer.appendChild(div);
                    } else {
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.textContent = item.nombre;
                            div.classList.add('search-result');
                            div.dataset.itemId = item.idItem; // Asignar el ID del item al dataset
                            div.addEventListener('click', () => {
                                itemInput.value = item.nombre;
                                document.getElementById('items_id').value = item.idItem; // Actualizar el campo oculto
                                itemResultsContainer.innerHTML = '';
                            });
                            itemResultsContainer.appendChild(div);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al realizar la búsqueda:', error);
                });
        } else {
            itemResultsContainer.innerHTML = '';
        }
    });

    solicitudInput.addEventListener('input', function () {
        const query = solicitudInput.value;

        if (query.length > 1) {
            fetch(`/solicitudes/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    solicitudResultsContainer.innerHTML = '';
                    if (data.length === 0) {
                        const div = document.createElement('div');
                        div.textContent = 'No se encontraron resultados';
                        solicitudResultsContainer.appendChild(div);
                    } else {
                        data.forEach(solicitud => {
                            const div = document.createElement('div');
                            div.textContent = solicitud.descripcionFalla;
                            div.classList.add('search-result');
                            div.dataset.solicitudId = solicitud.idSolicitud; // Asignar el ID de la solicitud al dataset
                            div.addEventListener('click', () => {
                                solicitudInput.value = solicitud.descripcionFalla;
                                document.getElementById('solicitudes_id').value = solicitud.idSolicitud; // Actualizar el campo oculto
                                solicitudResultsContainer.innerHTML = '';
                            });
                            solicitudResultsContainer.appendChild(div);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al realizar la búsqueda:', error);
                });
        } else {
            solicitudResultsContainer.innerHTML = '';
        }
    });
});

</script>

@endsection
