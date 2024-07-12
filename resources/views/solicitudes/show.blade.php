@extends('layouts.app')

@section('title', 'Detalles de Solicitud')

@section('content')
    <div class="container">
        <h1 class="my-4">Detalles de Solicitud</h1>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ Carbon\Carbon::parse($solicitud->fecha)->format('Y-m-d\TH:i') }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="descripcionFalla">Descripción de la Falla</label>
                <input type="text" class="form-control" id="descripcionFalla" name="descripcionFalla" value="{{ $solicitud->descripcionFalla }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="tiempoEstimado">Tiempo Estimado</label>
                <input type="text" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitud->tiempoEstimado }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="fechaInicio">Fecha de Inicio</label>
                <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitud->fechaInicio ? Carbon\Carbon::parse($solicitud->fechaInicio)->format('Y-m-d\TH:i') : '' }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="fechaTermina">Fecha de Término</label>
                <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitud->fechaTermina ? Carbon\Carbon::parse($solicitud->fechaTermina)->format('Y-m-d\TH:i') : '' }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
                <input type="text" class="form-control" id="mantenimientoEficiente" name="mantenimientoEficiente" value="{{ $solicitud->mantenimientoEficiente ? 'Sí' : 'No' }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="totalHorasTrabajadas">Total Horas Trabajadas</label>
                <input type="text" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" value="{{ $solicitud->totalHorasTrabajadas }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="tiempoParada">Tiempo de Parada</label>
                <input type="text" class="form-control" id="tiempoParada" name="tiempoParada" value="{{ $solicitud->tiempoParada }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="repuestosUtilizados">Repuestos Utilizados</label>
                <input type="text" class="form-control" id="repuestosUtilizados" name="repuestosUtilizados" value="{{ $solicitud->repuestosUtilizados }}" disabled>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="observaciones">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" disabled>{{ $solicitud->observaciones }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{ $solicitud->estado->nombre }}" disabled>
            </div>
            <div class="col-md-4">
                <label for="area">Área</label>
                <input type="text" class="form-control" id="area" name="area" value="{{ $solicitud->area->nombre }}" disabled>
            </div>
        </div>

        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
@endsection

@section('styles')
    <!-- Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-LMPl6W1Rz8mH5w1h6rzn1R+t4u37MzWLO8tL5AQQH6y36sTikV2XTuGPE5O5a+jfDfYlvLaZmlOYZwB2qYRsIg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
