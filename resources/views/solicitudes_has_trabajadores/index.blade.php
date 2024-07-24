@extends('layouts.app')

@section('title', 'Solicitudes Asignadas')

@section('content')
<div class="container-fluid">
        <h1 class="my-4">Listado de Solicitudes Asignadas a Trabajadores</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Solicitud</th>
                        <th>ID Trabajador</th>
                        <th>Nombre Trabajador</th>
                        <th>Fecha Asignación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudesHasTrabajadores as $asignacion)
                        <tr>
                            <td>{{ $asignacion->solicitudes_id }}</td>
                            <td>{{ $asignacion->trabajadores_id }}</td>
                            <td>{{ $asignacion->trabajador->nombre }}</td>
                            <td>{{ $asignacion->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('solicitudes_has_trabajadores.edit', $asignacion->idSolicitudtrabajadores) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('solicitudes_has_trabajadores.destroy', $asignacion->idSolicitudtrabajadores) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta asignación?');">
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

        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Volver al Listado de Solicitudes</a>
    </div>
@endsection
