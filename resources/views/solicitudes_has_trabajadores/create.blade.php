@extends('layouts.app')

@section('title', 'Asignar Solicitud a Trabajador')

@section('content')
    <div class="container">
        <h1 class="my-4">Asignar Solicitud a Trabajador</h1>

        <form method="POST" action="{{ route('solicitudes_has_trabajadores.store') }}">
            @csrf
            <div class="form-group">
                <label for="solicitudes_id">Solicitud</label>
                <select class="form-control" id="solicitudes_id" name="solicitudes_id" required>
                    @foreach($solicitudes as $solicitud)
                        <option value="{{ $solicitud->idSolicitud }}">{{ $solicitud->descripcionFalla }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="soli_tipoMantenimientos_id">Tipo de Mantenimiento</label>
                <select class="form-control" id="soli_tipoMantenimientos_id" name="soli_tipoMantenimientos_id" required>
                    @foreach($tiposMantenimientos as $tipoMantenimiento)
                        <option value="{{ $tipoMantenimiento->idTipomantenimiento }}">{{ $tipoMantenimiento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="solicitudes_estados_id">Estado</label>
                <select class="form-control" id="solicitudes_estados_id" name="solicitudes_estados_id" required>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->idEstado }}">{{ $estado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="trabajadores_id">Trabajador</label>
                <select class="form-control" id="trabajadores_id" name="trabajadores_id" required>
                    @foreach($trabajadores as $trabajador)
                        <option value="{{ $trabajador->idTrabajador }}">{{ $trabajador->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Asignar Solicitud a Trabajador</button>
            <a href="{{ route('solicitudes_has_trabajadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
