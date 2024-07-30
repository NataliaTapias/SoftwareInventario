@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Inventario</h1>

    <!-- Formulario de búsqueda y filtrado -->
    <form method="GET" action="{{ route('items.index') }}" class="row mb-4">
        <div class="col">
            <input type="text" name="search" class="form-control" placeholder="Buscar por referencia, nombre o descripción" value="{{ request('search') }}">
        </div>
        <div class="col">
            <select name="categoria" class="form-control">
                <option value="">Filtro por categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->idSubcategoria }}" {{ request('categoria') == $categoria->idSubcategoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-success">Buscar</button>
            <a href="{{ route('items.index') }}" class="btn btn-success">Limpiar Filtros</a>
        </div>
    </form>

    <!-- Botón Crear Ítem -->
    @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
    <div class="mb-4">
        <a href="{{ route('items.create') }}" class="btn btn-success">Crear Ítem</a>
    </div>
    @endif

    <!-- Botón Exportar Ítems -->
    <div class="mb-4">
        <a href="{{ route('export.items') }}" class="btn btn-success">Exportar Ítems a Excel</a>
    </div>

    <!-- Tabla de ítems -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Cantidad Mínima</th>
                <th>Unidad de Medida</th>
                <th>Subcategoría</th>
                <th>Estado</th>
                @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
                <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                 @php
                    $estadoClass = '';
                    if ($item->estado->nombre == 'Agotado') {
                        $estadoClass = 'estado-agotado';
                    } elseif ($item->estado->nombre == 'Disponible') {
                        $estadoClass = 'estado-disponible';
                    } elseif ($item->estado->nombre == 'Mínimo') {
                        $estadoClass = 'estado-minimo';
                    }
                @endphp
                <tr>
                    <td>{{ $item->idItem }}</td>
                    <td>{{ $item->referencia }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->cantidadMinima }}</td>
                    <td>{{ $item->unidadMedida }}</td>
                    <td>{{ $item->subcategoria->nombre ?? 'N/A' }}</td>
                    <td class="{{ $estadoClass }}">{{ $item->estado->nombre ?? 'N/A' }}</td>
                    @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('items.edit', $item->idItem) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('items.destroy', $item->idItem) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ítem?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    <div class="d-flex justify-content-center">
        {{ $items->links() }}
    </div>
</div>
@endsection

<style>
    .estado-agotado {
        background-color: #ffcccc !important; /* Rojo claro */
    }
    .estado-disponible {
        background-color: #ccffcc !important; /* Verde claro */
    }
    .estado-minimo {
        background-color: #ffe5b4 !important; /* Naranja claro */
    }

    .table td, .table th {
        vertical-align: middle; /* Asegura que el contenido de la celda esté centrado verticalmente */
    }

    .custom-btn {
    width: 5px; /* O un ancho específico como 100px */
}
}
</style>
