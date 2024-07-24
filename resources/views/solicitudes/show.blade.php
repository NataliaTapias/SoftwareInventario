@extends('layouts.app')

@section('title', 'Detalles de Solicitud')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('solicitudes.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Rol</h1>
    </div>

    <div class="row">
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ Carbon\Carbon::parse($solicitud->fecha)->format('Y-m-d\TH:i') }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="tiempoEstimado">Tiempo Estimado</label>
            <input type="text" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitud->tiempoEstimado }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="tipoMantenimiento">Tipo de Mantenimiento</label>
            <input type="text" class="form-control" id="tipoMantenimiento" name="tipoMantenimiento" value="{{ $solicitud->tipoMantenimiento->nombre }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio</label>
            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitud->fechaInicio ? Carbon\Carbon::parse($solicitud->fechaInicio)->format('Y-m-d\TH:i') : '' }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="fechaTermina">Fecha de Término</label>
            <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitud->fechaTermina ? Carbon\Carbon::parse($solicitud->fechaTermina)->format('Y-m-d\TH:i') : '' }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
            <input type="text" class="form-control" id="mantenimientoEficiente" name="mantenimientoEficiente" value="{{ $solicitud->mantenimientoEficiente ? 'Sí' : 'No' }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="trabajador">Trabajador Asignado</label>
            <input type="text" class="form-control" id="trabajador" name="trabajador" value="{{ $solicitud->trabajador ? $solicitud->trabajador->nombre : 'No Asignado' }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
            <input type="text" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" value="{{ $solicitud->totalHorasTrabajadas }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="tiempoParada">Tiempo de Parada</label>
            <input type="text" class="form-control" id="tiempoParada" name="tiempoParada" value="{{ $solicitud->tiempoParada }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="firmaDirector">Firma del Director</label>
            <input type="text" class="form-control" id="firmaDirector" name="firmaDirector" value="{{ $solicitud->firmaDirector }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="firmaGerente">Firma del Gerente</label>
            <input type="text" class="form-control" id="firmaGerente" name="firmaGerente" value="{{ $solicitud->firmaGerente }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="firmaLider">Firma del Líder</label>
            <input type="text" class="form-control" id="firmaLider" name="firmaLider" value="{{ $solicitud->firmaLider }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $solicitud->estado->nombre }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="area">Área</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ $solicitud->area->nombre }}" disabled>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="descripcionFalla">Descripción de la Falla</label>
                <textarea class="form-control" id="descripcionFalla" name="descripcionFalla" rows="3" disabled>{{ $solicitud->descripcionFalla }}</textarea>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" disabled>{{ $solicitud->observaciones }}</textarea>
            </div>
        </div>
    </div>


    <div class="col-12 mb-3">
            <div class="form-group">
                <label for="repuestosUtilizados">Repuestos Utilizados</label>
                <textarea class="form-control" id="repuestosUtilizados" name="repuestosUtilizados" rows="3" disabled>{{ $solicitud->repuestosUtilizados }}</textarea>
            </div>
        </div>

</div>
@endsection

@section('styles')
    <!-- Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-LMPl6W1Rz8mH5w1h6rzn1R+t4u37MzWLO8tL5AQQH6y36sTikV2XTuGPE5O5a+jfDfYlvLaZmlOYZwB2qYRsIg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
