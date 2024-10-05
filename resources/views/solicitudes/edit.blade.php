@extends('layouts.app')

@section('title', 'Editar Solicitud')

<style>
    .custom-file-input:lang(es) ~ .custom-file-label::after {
        content: "Browse";
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4" style="gap: 1rem;">
        <a href="{{ route('solicitudes.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Solicitud</h1>
    </div>
    <form method="POST" action="{{ route('solicitudes.update', $solicitude->idSolicitud) }}" enctype="multipart/form-data" class="px-5">
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

        <div class="">
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="fecha">Fecha</label>
                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ Carbon\Carbon::parse($solicitude->fecha)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="col-md-4">
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
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Mantenimiento Eficiente</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="mantenimientoEficienteSi" name="mantenimientoEficiente" value="1" {{$solicitude->mantenimientoEficiente == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mantenimientoEficienteSi">Sí</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="mantenimientoEficienteNo" name="mantenimientoEficiente" value="0" {{$solicitude->mantenimientoEficiente == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mantenimientoEficienteNo">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
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
                </div>

                <div class="col-md-2">
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

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tiempoEstimado">Tiempo Estimado</label>
                        <input type="time" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitude->tiempoEstimado }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="tiempoParada">Tiempo de Parada</label>
                        <input type="time" class="form-control" id="tiempoParada" name="tiempoParada" value="{{ $solicitude->tiempoParada }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="totalHorasTrabajadas">Total de Horas Trabajadas</label>
                        <input type="time" class="form-control" id="totalHorasTrabajadas" name="totalHorasTrabajadas" value="{{ $solicitude->totalHorasTrabajadas }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fechaInicio">Fecha de Inicio</label>
                        <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitude->fechaInicio ? Carbon\Carbon::parse($solicitude->fechaInicio)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fechaTermina">Fecha de Término</label>
                        <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitude->fechaTermina ? Carbon\Carbon::parse($solicitude->fechaTermina)->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="descripcionFalla">Descripción de la Falla</label>
                        <input class="form-control" id="descripcionFalla" name="descripcionFalla" value="{{ $solicitude->descripcionFalla }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="trabajadores_id">Asignar Trabajador</label>
                        <select class="form-control" id="trabajadores_id" name="trabajadores_id">
                            <option value="">-- No Asignar --</option>
                            @foreach($trabajadores as $trabajador)
                                <option value="{{ $trabajador->idTrabajador }}" {{ $solicitude && $solicitude->trabajadorId == $trabajador->idTrabajador ? 'selected' : '' }}>
                                    {{ $trabajador->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones">{{ $solicitude->observaciones }}</textarea>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <label for="repuestosUtilizados">Repuestos Utilizados</label>
                        <textarea class="form-control" id="repuestosUtilizados" name="repuestosUtilizados" disabled>{{ $solicitude->repuestosUtilizados }}</textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="firmaDirector">Firma del Director</label>
                        @if ($solicitude->firmaDirector)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaDirector) }}" alt="Firma del Director" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="firmaDirector" name="firmaDirector" accept="image/*">
                            <label class="custom-file-label" for="firmaDirector">Seleccionar archivo</label>
                        </div>
                        <img id="previewFirmaDirector" class="mt-2" src="" alt="Previsualización de la firma del Director" style="max-width: 200px; display:none;">
                        <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del director.</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="firmaGerente">Firma del Gerente</label>
                        @if ($solicitude->firmaGerente)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaGerente) }}" alt="Firma del Gerente" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="firmaGerente" name="firmaGerente" accept="image/*">
                            <label class="custom-file-label" for="firmaGerente">Seleccionar archivo</label>
                        </div>
                        <img id="previewFirmaGerente" class="mt-2" src="" alt="Previsualización de la firma del Gerente" style="max-width: 200px; display:none;">
                        <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del gerente.</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="firmaLider">Firma del Líder</label>
                        @if ($solicitude->firmaLider)
                            <div>
                                <img src="{{ asset('storage/' . $solicitude->firmaLider) }}" alt="Firma del Líder" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="firmaLider" name="firmaLider" accept="image/*">
                            <label class="custom-file-label" for="firmaLider">Seleccionar archivo</label>
                        </div>
                        <img id="previewFirmaLider" class="mt-2" src="" alt="Previsualización de la firma del Líder" style="max-width: 200px; display:none;">
                        <small class="form-text text-muted mt-1">Por favor, suba una imagen de la firma del lider.</small>
                    </div>
                </div>
            </div>            
        </div> 

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Espera 5 segundos antes de ocultar la alerta
        setTimeout(function() {
            // Obtén las alertas
            let successAlert = document.getElementById('success-alert');
            let errorAlert = document.getElementById('error-alert');
            
            // Si hay una alerta de éxito, agrega la clase de fade out y se remueve
            if (successAlert) {
                successAlert.classList.remove('show'); // Oculta la alerta suavemente
                successAlert.classList.add('fade'); // Agrega clase fade
                successAlert.addEventListener('transitionend', function() {
                    successAlert.remove(); // Remueve la alerta del DOM
                });
            }

            // Si hay una alerta de error, agrega la clase de fade out y se remueve
            if (errorAlert) {
                errorAlert.classList.remove('show'); // Oculta la alerta suavemente
                errorAlert.classList.add('fade'); // Agrega clase fade
                errorAlert.addEventListener('transitionend', function() {
                    errorAlert.remove(); // Remueve la alerta del DOM
                });
            }
        }, 5000);

        document.getElementById('firmaDirector').addEventListener('change', function(event) {
            previewImage(event, 'previewFirmaDirector');
        });

        document.getElementById('firmaGerente').addEventListener('change', function(event) {
            previewImage(event, 'previewFirmaGerente');
        });

        document.getElementById('firmaLider').addEventListener('change', function(event) {
            previewImage(event, 'previewFirmaLider');
        });

        function previewImage(event, previewId) {
        const reader = new FileReader();
        const file = event.target.files[0];
        
        if (file) {
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    });
</script>