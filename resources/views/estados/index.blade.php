@extends('layouts.app')

@section('title', 'Estados')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Estados</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('estados.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>

        <!-- Botón Crear Estado -->
        <div class="mb-4">
            <a href="{{ route('estados.create') }}" class="btn btn-success">Crear Estado</a>
        </div>

        <!-- Tabla de estados -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estados as $estado)
                    <tr>
                        <td>{{ $estado->idEstado }}</td>
                        <td>{{ $estado->nombre }}</td>
                        <td>{{ $estado->tipo }}</td>
                        <td>{{ $estado->created_at }}</td>
                        <td>{{ $estado->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('estados.edit', $estado->idEstado) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('estados.destroy', $estado->idEstado) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este estado?');">
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
