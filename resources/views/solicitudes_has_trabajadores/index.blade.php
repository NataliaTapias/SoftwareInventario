@extends('layouts.app')

@section('title', 'Solicitudes Asignadas')

@section('content')
    <div class="container">
        <h1 class="my-4">Listado de Solicitudes Asignadas a Trabajadores</h1>

        <table class="table table-bordered">
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
                            <a href="{{ route('solicitudes_has_trabajadores.edit', $asignacion->idSolicitudtrabajadores) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('solicitudes_has_trabajadores.destroy', $asignacion->idSolicitudtrabajadores) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Volver al Listado de Solicitudes</a>
    </div>
@endsection
