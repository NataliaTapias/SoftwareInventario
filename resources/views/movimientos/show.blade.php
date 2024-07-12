@extends('layouts.app')

@section('title', 'Detalles del Movimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Detalles del Movimiento</h1>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ $movimiento->fecha }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ $movimiento->numRemisionProveedor }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="firma">Firma</label>
                <input type="text" class="form-control" id="firma" name="firma" value="{{ $movimiento->firma }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="colaborador">Colaborador</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ $movimiento->colaborador }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="item">Item</label>
                <input type="text" class="form-control" id="item" value="{{ $movimiento->item->nombre }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $movimiento->cantidad }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $movimiento->precio }}" disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label for="total">Total</label>
                <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ $movimiento->total }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="tipoMovimientos_id">Tipo de Movimiento</label>
                <input type="text" class="form-control" value="{{ $movimiento->tipoMovimiento->nombre }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="solicitud">Solicitud</label>
                <input type="text" class="form-control" value="{{ $movimiento->solicitud->descripcionFalla }}" disabled>
            </div>
            <div class="col-md-3">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ $movimiento->proveedor }}" disabled>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3" disabled>{{ $movimiento->observacion }}</textarea>
        </div>

        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
