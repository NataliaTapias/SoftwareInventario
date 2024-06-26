@extends('layouts.app')

@section('title', 'Listado de Solicitudes')

@section('content')
    <div class="container">
        <h1 class="my-4">Listado de Solicitudes</h1>

        <!-- Botón para crear una nueva solicitud -->
        <a href="{{ route('solicitudes.create') }}" class="btn btn-success mb-3">Crear Nueva Solicitud</a>

        <!-- Botón para ver todas las solicitudes asignadas a trabajadores -->
        <a href="{{ route('solicitudes_has_trabajadores.index') }}" class="btn btn-info mb-3">Ver Solicitudes Asignadas a Trabajadores</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->idSolicitud }}</td>
                        <td>{{ $solicitud->fecha }}</td>
                        <td>{{ $solicitud->descripcionFalla }}</td>
                        <td>{{ $solicitud->estado->nombre }}</td>
                        <td>
                            <a href="{{ route('solicitudes.edit', $solicitud->idSolicitud) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('solicitudes.destroy', $solicitud->idSolicitud) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
