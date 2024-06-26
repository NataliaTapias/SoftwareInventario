@extends('layouts.app')

@section('title', 'Editar Asignación de Solicitud a Trabajador')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Asignación de Solicitud a Trabajador</h1>

    <form method="POST" action="{{ route('solicitudes_has_trabajadores.update', $solicitudHasTrabajador->idSolicitudtrabajadores) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="solicitudes_id">Solicitud</label>
                    <select class="form-control" id="solicitudes_id" name="solicitudes_id" required>
                        @foreach($solicitudes as $solicitud)
                            <option value="{{ $solicitud->idSolicitud }}" {{ $solicitud->idSolicitud == $solicitudHasTrabajador->solicitudes_id ? 'selected' : '' }}>{{ $solicitud->descripcionFalla }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="soli_tipoMantenimientos_id">Tipo de Mantenimiento</label>
                    <select class="form-control" id="soli_tipoMantenimientos_id" name="soli_tipoMantenimientos_id" required>
                        @foreach($tiposMantenimientos as $tipoMantenimiento)
                            <option value="{{ $tipoMantenimiento->idTipomantenimiento }}" {{ $tipoMantenimiento->idTipomantenimiento == $solicitudHasTrabajador->soli_tipoMantenimientos_id ? 'selected' : '' }}>{{ $tipoMantenimiento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="solicitudes_estados_id">Estado</label>
                    <select class="form-control" id="solicitudes_estados_id" name="solicitudes_estados_id" required>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->idEstado }}" {{ $estado->idEstado == $solicitudHasTrabajador->solicitudes_estados_id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="trabajadores_id">Trabajador</label>
                    <select class="form-control" id="trabajadores_id" name="trabajadores_id" required>
                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->idTrabajador }}" {{ $trabajador->idTrabajador == $solicitudHasTrabajador->trabajadores_id ? 'selected' : '' }}>{{ $trabajador->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
        <a href="{{ route('solicitudes_has_trabajadores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
