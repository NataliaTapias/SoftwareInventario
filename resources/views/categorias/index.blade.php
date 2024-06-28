@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Categorías</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('categorias.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Botón Crear Categoría -->
        <div class="mb-4">
            <a href="{{ route('categorias.create') }}" class="btn btn-success">Crear Categoría</a>
        </div>

        <!-- Tabla de categorías -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->idCategoria }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->created_at }}</td>
                        <td>{{ $categoria->updated_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('categorias.edit', $categoria->idCategoria) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categorias.destroy', $categoria->idCategoria) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
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
