@extends('layouts.app')

@section('title', 'Lista de Solicitudes')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Lista de Solicitudes</h1>

    @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
    <div class="mb-3">
        <a href="{{ route('solicitudes.create') }}" class="btn btn-success">Crear Solicitud</a>
    </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de búsqueda y filtros -->
    <form action="{{ route('solicitudes.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-md-3">
                <select name="estado_id" id="estado_id" class="form-control">
                <option value="">Filtro por estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->id }}" {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="areas_id" id="areas_id" class="form-control" aria-label="Filtrar por área">
                    <option value="">{{ request('area_id') ? '' : 'Filtrar por área' }}</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ request('areas_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

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
                    <td>{{ $solicitud->fechaInicio ? $solicitud->fechaInicio : 'N/A' }}</td>
                    <td>{{ $solicitud->fechaTermina ? $solicitud->fechaTermina : 'N/A' }}</td>
                    <td>{{ $solicitud->mantenimientoEficiente ? 'Sí' : 'No' }}</td>
                    <td>{{ $solicitud->totalHorasTrabajadas }}</td>
                    <td>{{ $solicitud->tiempoParada }}</td>
                    <td>{{ $solicitud->repuestosUtilizados }}</td>
                    <td>{{ $solicitud->observaciones }}</td>
                    <td>{{ $solicitud->estado->nombre }}</td>
                    <td>{{ $solicitud->area->nombre }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('solicitudes.show', $solicitud->idSolicitud) }}" class="btn btn-info btn-sm mr-1">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(!Auth::user()->hasRole('consultor') && !Auth::user()->hasRole('logistica'))
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
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Enlaces de paginación -->
    {{ $solicitudes->links() }}
</div>
@endsection
