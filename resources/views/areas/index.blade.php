@extends('layouts.app')

@section('title', 'Áreas')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Áreas</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('areas.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>

        <!-- Botón Crear Área -->
        <div class="mb-4">
            <a href="{{ route('areas.create') }}" class="btn btn-success">Crear Área</a>
        </div>

        <!-- Tabla de áreas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                    <tr>
                        <td>{{ $area->idArea }}</td>
                        <td>{{ $area->nombre }}</td>
                        <td>{{ $area->created_at }}</td>
                        <td>{{ $area->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('areas.edit', $area->idArea) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('areas.destroy', $area->idArea) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta área?');">
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
