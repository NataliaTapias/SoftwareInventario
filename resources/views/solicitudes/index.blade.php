@extends('layouts.app')

@section('title', 'Solicitudes')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Solicitudes</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('solicitudes.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por firma, estado o área" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Botón Crear Solicitud -->
        <div class="mb-4">
            <a href="{{ route('solicitudes.create') }}" class="btn btn-success">Crear Solicitud</a>
        </div>

        <!-- Tabla de solicitudes -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Descripción de la Falla</th>
                    <th>Tiempo Estimado</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Estado</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->idSolicitud }}</td>
                        <td>{{ $solicitud->fecha }}</td>
                        <td>{{ $solicitud->descripcionFalla }}</td>
                        <td>{{ $solicitud->tiempoEstimado }}</td>
                        <td>{{ $solicitud->tipoMantenimiento->nombre }}</td>
                        <td>{{ $solicitud->estado->nombre }}</td>
                        <td>{{ $solicitud->area->nombre }}</td>
                        <td>
                            <a href="{{ route('solicitudes.edit', $solicitud->idSolicitud) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                            <form action="{{ route('solicitudes.destroy', $solicitud->idSolicitud) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
