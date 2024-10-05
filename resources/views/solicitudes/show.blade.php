@extends('layouts.app')

@section('title', 'Detalles de Solicitud')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('solicitudes.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Detalle de solicitud</h1>
    </div>

    <div class="row px-5">
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ Carbon\Carbon::parse($solicitud->fecha)->format('Y-m-d\TH:i') }}" disabled>
        </div>
    </div>

    <div class="col-md-5 mb-3">
        <div class="form-group">
            <label for="tipoMantenimiento">Tipo de Mantenimiento</label>
            <input type="text" class="form-control" id="tipoMantenimiento" name="tipoMantenimiento" value="{{ $solicitud->tipoMantenimiento->nombre }}" disabled>
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio</label>
            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ $solicitud->fechaInicio ? Carbon\Carbon::parse($solicitud->fechaInicio)->format('Y-m-d\TH:i') : '' }}" disabled>
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <div class="form-group">
            <label for="fechaTermina">Fecha de Término</label>
            <input type="datetime-local" class="form-control" id="fechaTermina" name="fechaTermina" value="{{ $solicitud->fechaTermina ? Carbon\Carbon::parse($solicitud->fechaTermina)->format('Y-m-d\TH:i') : '' }}" disabled>
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <div class="form-group">
            <label for="mantenimientoEficiente">Mantenimiento Eficiente</label>
            <input type="text" class="form-control" id="mantenimientoEficiente" name="mantenimientoEficiente" value="{{ $solicitud->mantenimientoEficiente ? 'Sí' : 'No' }}" disabled>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="form-group">
            <label for="trabajador">Trabajador Asignado</label>
            <input type="text" class="form-control" id="trabajador" name="trabajador" value="{{ $solicitud->trabajadoresAsignados[0]['trabajadorNombre']}}" disabled>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $solicitud->estado->nombre }}" disabled>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="area">Área</label>
            <input type="text" class="form-control" id="area" name="area" value="{{ $solicitud->area->nombre }}" disabled>
        </div>
    </div>
    
    <div class="col-md-2 mb-3">
        <div class="form-group">
            <label for="tiempoEstimado">Tiempo Estimado</label>
            <input type="text" class="form-control" id="tiempoEstimado" name="tiempoEstimado" value="{{ $solicitud->tiempoEstimado }}" disabled>
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
</div>


    <div class="row px-5">
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

    <div class="col-12 mb-3 px-5">
        <label for="repuestosUtilizados">Repuestos Utilizados</label>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Repuesto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (json_decode($solicitud->repuestosUtilizados, true) as $repuesto)
                        <tr>
                            <td>
                                {{ $repuesto['repuestoNombre'] }}
                            </td>
                            <td>
                                {{ $repuesto['repuestoCantidad'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row px-5">
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="firmaDirector">Firma del Director</label>
                @if ($solicitud->firmaDirector)
                    <div>
                        <!-- Link para ampliar la imagen -->
                        <a href="{{ asset('storage/' . $solicitud->firmaDirector) }}" data-lightbox="firmaDirector" data-title="Firma del Director" target="_blank">
                            <img src="{{ asset('storage/' . $solicitud->firmaDirector) }}" alt="Firma del Director" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                        </a>
                    </div>
        
                    <!-- Botón de descarga debajo de la imagen -->
                    <a href="{{ asset('storage/' . $solicitud->firmaDirector) }}" download="firma_director" class="btn btn-primary mt-2">
                        Descargar Firma
                    </a>
                @else
                    <input type="text" class="form-control" id="firmaDirector" name="firmaDirector" value="Firma sin cargar" disabled>
                @endif
            </div>
        </div>
    
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="firmaGerente">Firma del Gerente</label>
                @if ($solicitud->firmaGerente)
                    <div>
                        <!-- Link para ampliar la imagen -->
                        <a href="{{ asset('storage/' . $solicitud->firmaGerente) }}" data-lightbox="firmaGerente" data-title="Firma del Gerente" target="_blank">
                            <img src="{{ asset('storage/' . $solicitud->firmaGerente) }}" alt="Firma del Gerente" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                        </a>
                    </div>
        
                    <!-- Botón de descarga debajo de la imagen -->
                    <a href="{{ asset('storage/' . $solicitud->firmaGerente) }}" download="firma_gerente" class="btn btn-primary mt-2">
                        Descargar Firma
                    </a>
                @else
                    <input type="text" class="form-control" id="firmaGerente" name="firmaGerente" value="Firma sin cargar" disabled>
                @endif
            </div>
        </div>
    
        <div class="col-md-4 mb-3">
            <div class="form-group">
                <label for="firmaLider">Firma del Líder</label>
                @if ($solicitud->firmaLider)
                    <div>
                        <!-- Link para ampliar la imagen -->
                        <a href="{{ asset('storage/' . $solicitud->firmaLider) }}" data-lightbox="firmaLider" data-title="Firma del Líder" target="_blank">
                            <img src="{{ asset('storage/' . $solicitud->firmaLider) }}" alt="Firma del Líder" style="max-width: 150px; max-height: 100px; margin-bottom: 10px;">
                        </a>
                    </div>
        
                    <!-- Botón de descarga debajo de la imagen -->
                    <a href="{{ asset('storage/' . $solicitud->firmaLider) }}" download="firma_lider" class="btn btn-primary mt-2">
                        Descargar Firma
                    </a>
                @else
                    <input type="text" class="form-control" id="firmaLider" name="firmaLider" value="Firma sin cargar" disabled>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('styles')
    <!-- Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-LMPl6W1Rz8mH5w1h6rzn1R+t4u37MzWLO8tL5AQQH6y36sTikV2XTuGPE5O5a+jfDfYlvLaZmlOYZwB2qYRsIg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Incluir CSS y JS de Lightbox -->
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>
@endsection
