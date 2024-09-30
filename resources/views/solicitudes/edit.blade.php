@extends('layouts.app')

@section('title', 'Editar Solicitud')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4" style="gap: 1rem;">
        <a href="{{ route('solicitudes.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Solicitud</h1>
    </div>
    <form method="POST" action="{{ route('solicitudes.update', $solicitude->idSolicitud) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger fade show" role="alert" id="error-alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ Carbon\Carbon::parse($solicitude->fecha)->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="form-group">
                        <label for="tiempoEstimado">Tiempo Estimado</label>
                        <input type="time" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitude->tiempoEstimado }}">
                    </div>

                    <div class="form-group">
                        <label for="tipoMantenimientos_id">Tipo de Mantenimiento</label>
                        <select class="form-control" id="tipoMantenimientos_id" name="tipoMantenimientos_id">
                            @foreach($tiposMantenimientos as $tipoMantenimiento)
                                <option value="{{ $tipoMantenimiento->idTipomantenimiento }}" {{ $solicitude->tipoMantenimientos_id == $tipoMantenimiento->idTipomantenimiento ? 'selected' : '' }}>
                                    {{ $tipoMantenimiento->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fechaInicio">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitude->fechaInicio ? Carbon\Carbon::parse($solicitude->fechaInicio)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="mantenimientoEficiente" name="mantenimientoEficiente" value="1" {{ $solicitude->mantenimientoEficiente ? 'checked' : '' }}>
                            <label class="form-check-label" for="mantenimientoEficiente">Sí</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
                        <input type="time" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" value="{{ $solicitude->totalHorasTrabajadas }}">
                    </div>

                    <div class="form-group">
                        <label for="tiempoParada">Tiempo de Parada</label>
                        <input type="time" class="form-control" id="tiempoParada" name="tiempoParada" value="{{ $solicitude->tiempoParada }}">
                    </div>

                    <div class="form-group">
                        <label for="firmaDirector">Firma del Director</label>
                        @if ($solicitude->firmaDirector)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaDirector) }}" alt="Firma del Director" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="firmaDirector" name="firmaDirector" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label for="firmaGerente">Firma del Gerente</label>
                        @if ($solicitude->firmaGerente)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaGerente) }}" alt="Firma del Gerente" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="firmaGerente" name="firmaGerente" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label for="firmaLider">Firma del Líder</label>
                        @if ($solicitude->firmaLider)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaLider) }}" alt="Firma del Líder" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="firmaLider" name="firmaLider" accept="image/*">
                    </div>
                    
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fechaTermina">Fecha de Término</label>
                        <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitude->fechaTermina ? Carbon\Carbon::parse($solicitude->fechaTermina)->format('Y-m-d\TH:i') : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="trabajadores_id">Asignar Trabajador</label>
                        <select class="form-control" id="trabajadores_id" name="trabajadores_id">
                            <option value="">-- No Asignar --</option>
                            @foreach($trabajadores as $trabajador)
                                <option value="{{ $trabajador->idTrabajador }}" {{ $solicitudHasTrabajador && $solicitudHasTrabajador->trabajadores_id == $trabajador->idTrabajador ? 'selected' : '' }}>
                                    {{ $trabajador->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estados_id">Estado</label>
                        <select class="form-control" id="estados_id" name="estados_id">
                            @foreach($estados as $estado)
                                <option value="{{ $estado->idEstado }}" {{ $solicitude->estados_id == $estado->idEstado ? 'selected' : '' }}>
                                    {{ $estado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="areas_id">Área</label>
                        <select class="form-control" id="areas_id" name="areas_id">
                            @foreach($areas as $area)
                                <option value="{{ $area->idArea }}" {{ $solicitude->areas_id == $area->idArea ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="descripcionFalla">Descripción de la Falla</label>
                        <textarea class="form-control" id="descripcionFalla" name="descripcionFalla">{{ $solicitude->descripcionFalla }}</textarea>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones">{{ $solicitude->observaciones }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="repuestosUtilizados">Repuestos Utilizados</label>
                <textarea class="form-control" id="repuestosUtilizados" name="repuestosUtilizados">{{ $solicitude->repuestosUtilizados }}</textarea>
            </div>
        </div> 

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
        </div>
    </form>
</div>
@endsection
