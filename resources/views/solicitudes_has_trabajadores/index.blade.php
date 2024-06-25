@extends('layouts.app')

@section('title', 'Solicitudes asignadas a Trabajadores')

@section('content')
    <div class="container">
        <h1 class="my-4">Solicitudes asignadas a Trabajadores</h1>

<!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('solicitudes_has_trabajadores.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por descripción de la solicitud" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>


        <a href="{{ route('solicitudes_has_trabajadores.create') }}" class="btn btn-success mb-4">Asignar Solicitud a Trabajador</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Solicitud</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Estado</th>
                    <th>Trabajador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudesHasTrabajadores as $solicitudHasTrabajador)
                    <tr>
                        <td>{{ $solicitudHasTrabajador->idSolicitudtrabajadores }}</td>
                        <td>{{ $solicitudHasTrabajador->solicitud->descripcionFalla }}</td>
                        <td>{{ $solicitudHasTrabajador->tipoMantenimiento->nombre }}</td>
                        <td>{{ $solicitudHasTrabajador->estado->nombre }}</td>
                        <td>{{ $solicitudHasTrabajador->trabajador->nombre }}</td>
                        <td>
                            <a href="{{ route('solicitudes_has_trabajadores.edit', $solicitudHasTrabajador->idSolicitudtrabajadores) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('solicitudes_has_trabajadores.destroy', $solicitudHasTrabajador->idSolicitudtrabajadores) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta asignación?');">
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
