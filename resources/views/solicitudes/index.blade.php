@extends('layouts.app')

@section('title', 'Lista de Solicitudes')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Lista de Solicitudes</h1>
    <div class="mb-3">
        <a href="{{ route('solicitudes.create') }}" class="btn btn-success">Crear Solicitud</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Descripción de la Falla</th>
                    <th>Tiempo Estimado</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Término</th>
                    <th>Mantenimiento Eficiente</th>
                    <th>Total Horas Trabajadas</th>
                    <th>Tiempo de Parada</th>
                    <th>Repuestos Utilizados</th>
                    <th>Observaciones</th>
                    <th>Estado</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->idSolicitud }}</td>
                    <td>{{ Carbon\Carbon::parse($solicitud->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $solicitud->descripcionFalla }}</td>
                    <td>{{ $solicitud->tiempoEstimado }}</td>
                    <td>{{ $solicitud->fechaInicio ? Carbon\Carbon::parse($solicitud->fechaInicio)->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td>{{ $solicitud->fechaTermina ? Carbon\Carbon::parse($solicitud->fechaTermina)->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td>{{ $solicitud->mantenimientoEficiente ? 'Sí' : 'No' }}</td>
                    <td>{{ $solicitud->totalHorasTrabajadas }}</td>
                    <td>{{ $solicitud->tiempoParada }}</td>
                    <td>{{ $solicitud->repuestosUtilizados }}</td>
                    <td>{{ $solicitud->observaciones }}</td>
                    <td>{{ $solicitud->estado->nombre }}</td>
                    <td>{{ $solicitud->area->nombre }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('solicitudes.edit', $solicitud->idSolicitud) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('solicitudes.destroy', $solicitud->idSolicitud) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?');">
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
</div>
@endsection
