@extends('layouts.app')

@section('title', 'Editar Solicitud')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Solicitud</h1>

        <form method="POST" action="{{ route('solicitudes.update', $solicitud->idSolicitud) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ \Carbon\Carbon::parse($solicitud->fecha)->format('Y-m-d\TH:i') }}" required>
            </div>
            <div class="form-group">
                <label for="descripcionFalla">Descripción de la Falla</label>
                <textarea class="form-control" id="descripcionFalla" name="descripcionFalla" required>{{ $solicitud->descripcionFalla }}</textarea>
            </div>
            <div class="form-group">
                <label for="tiempoEstimado">Tiempo Estimado</label>
                <input type="text" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitud->tiempoEstimado }}">
            </div>
            <div class="form-group">
                <label for="tipoMantenimientos_id">Tipo de Mantenimiento</label>
                <select class="form-control" id="tipoMantenimientos_id" name="tipoMantenimientos_id" required>
                    @foreach($tiposMantenimientos as $tipoMantenimiento)
                        <option value="{{ $tipoMantenimiento->idTipomantenimiento }}" {{ $solicitud->tipoMantenimientos_id == $tipoMantenimiento->idTipomantenimiento ? 'selected' : '' }}>{{ $tipoMantenimiento->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fechaInicio">Fecha de Inicio</label>
                <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitud->fechaInicio ? \Carbon\Carbon::parse($solicitud->fechaInicio)->format('Y-m-d\TH:i') : '' }}">
            </div>
            <div class="form-group">
                <label for="fechaTermina">Fecha de Terminación</label>
                <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitud->fechaTermina ? \Carbon\Carbon::parse($solicitud->fechaTermina)->format('Y-m-d\TH:i') : '' }}">
            </div>
            <div class="form-group">
                <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
                <select class="form-control" id="mantenimientoEficiente" name="mantenimientoEficiente">
                    <option value="1" {{ $solicitud->mantenimientoEficiente ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$solicitud->mantenimientoEficiente ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
                <input type="number" step="0.01" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" value="{{ $solicitud->totalHorasTrabajadas }}">
            </div>
            <div class="form-group">
                <label for="tiempoParada">Tiempo de Parada</label>
                <input type="number" step="0.01" class="form-control" id="tiempoParada" name="tiempoParada" value="{{ $solicitud->tiempoParada }}">
            </div>
            <div class="form-group">
                <label for="repuestosUtilizados">Repuestos Utilizados</label>
                <textarea class="form-control" id="repuestosUtilizados" name="repuestosUtilizados">{{ $solicitud->repuestosUtilizados }}</textarea>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones">{{ $solicitud->observaciones }}</textarea>
            </div>
            <div class="form-group">
                <label for="firmaDirector">Firma del Director</label>
                <input type="text" class="form-control" id="firmaDirector" name="firmaDirector" value="{{ $solicitud->firmaDirector }}">
            </div>
            <div class="form-group">
                <label for="firmaGerente">Firma del Gerente</label>
                <input type="text" class="form-control" id="firmaGerente" name="firmaGerente" value="{{ $solicitud->firmaGerente }}">
            </div>
            <div class="form-group">
                <label for="firmaLider">Firma del Líder</label>
                <input type="text" class="form-control" id="firmaLider" name="firmaLider" value="{{ $solicitud->firmaLider }}">
            </div>
            <div class="form-group">
                <label for="estados_id">Estado</label>
                <select class="form-control" id="estados_id" name="estados_id" required>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->idEstado }}" {{ $solicitud->estados_id == $estado->idEstado ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="areas_id">Área</label>
                <select class="form-control" id="areas_id" name="areas_id" required>
                    @foreach($areas as $area)
                        <option value="{{ $area->idArea }}" {{ $solicitud->areas_id == $area->idArea ? 'selected' : '' }}>{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
