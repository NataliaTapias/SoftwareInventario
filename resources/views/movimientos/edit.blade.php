@extends('layouts.app')

@section('title', 'Editar Movimiento')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('movimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Movimiento</h1>
    </div>

    <form method="POST" action="{{ route('movimientos.update', $movimiento->idMovimiento) }}" class="col-md-10 mx-auto">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ $movimiento->fecha }}" disabled>
                <input type="hidden" name="fecha" value="{{ $movimiento->fecha }}">
            </div>
            <div class="col-md-3">
                <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ $movimiento->numRemisionProveedor }}" disabled>
                <input type="hidden" name="numRemisionProveedor" value="{{ $movimiento->numRemisionProveedor }}">
            </div>
            <div class="col-md-3">
                <label for="firma">Firma</label>
                <input type="text" class="form-control" id="firma" name="firma" value="{{ $movimiento->firma }}" disabled>
                <input type="hidden" name="firma" value="{{ $movimiento->firma }}">
            </div>
            <div class="col-md-3">
                <label for="colaborador">Colaborador</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ $movimiento->colaborador }}" disabled>
                <input type="hidden" name="colaborador" value="{{ $movimiento->colaborador }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="item-search">Item</label>
                <input type="text" id="item-search" class="form-control" value="{{ $movimiento->item->nombre }}" disabled>
                <input type="hidden" name="items_id" value="{{ $movimiento->items_id }}">
            </div>
            <div class="col-md-3">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $movimiento->cantidad }}" disabled>
                <input type="hidden" name="cantidad" value="{{ $movimiento->cantidad }}">
            </div>
            <div class="col-md-3">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $movimiento->precio }}" disabled>
                <input type="hidden" name="precio" value="{{ $movimiento->precio }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="total">Total</label>
                <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ $movimiento->total }}" disabled>
                <input type="hidden" name="total" value="{{ $movimiento->total }}">
            </div>
            <div class="col-md-3">
                <label for="tipoMovimientos_id">Tipo de Movimiento</label>
                <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" disabled>
                    @foreach($tiposMovimientos as $tipoMovimiento)
                        <option value="{{ $tipoMovimiento->idTipomovimiento }}" {{ $movimiento->tipoMovimientos_id == $tipoMovimiento->idTipomovimiento ? 'selected' : '' }}>
                            {{ $tipoMovimiento->nombre }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="tipoMovimientos_id" value="{{ $movimiento->tipoMovimientos_id }}">
            </div>
            <div class="col-md-3">
                <label for="solicitud-search">Solicitud</label>
                <input type="text" id="solicitud-search" class="form-control" value="{{ $movimiento->solicitud->descripcionFalla ?? '' }}" disabled>
                <input type="hidden" name="solicitudes_id" value="{{ $movimiento->solicitudes_id }}">
            </div>
            <div class="form-group mb-3">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ $movimiento->proveedor }}" disabled>
                <input type="hidden" name="proveedor" value="{{ $movimiento->proveedor }}">
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3" style="word-wrap: break-word; overflow-wrap: break-word;" >{{ $movimiento->observacion }}</textarea>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

    });
</script>
@endsection
