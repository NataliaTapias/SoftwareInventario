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
            </div>
        </form>

        <!-- Botón Crear Ítem -->
        <div class="mb-4">
            <a href="{{ route('items.create') }}" class="btn btn-success">Crear Ítem</a>
        </div>

        <!-- Tabla de ítems -->
        <table class="table table-striped">
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
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $Item)
                    <tr>
                        <td>{{ $Item->idItem }}</td>
                        <td>{{ $Item->referencia }}</td>
                        <td>{{ $Item->nombre }}</td>
                        <td>{{ $Item->descripcion }}</td>
                        <td>{{ $Item->cantidad }}</td>
                        <td>{{ $Item->cantidadMinima }}</td>
                        <td>{{ $Item->unidadMedida }}</td>
                        <td>{{ $Item->subcategoria->nombre ?? 'N/A' }}</td>
                        <td>{{ $Item->estado->nombre ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('items.edit', $Item->idItem) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('items.destroy', $Item->idItem) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ítem?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
@endsection
