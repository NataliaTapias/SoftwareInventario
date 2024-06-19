@extends('layouts.app')

@section('title', 'Editar Movimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Movimiento</h1>

        <form method="POST" action="{{ route('movimientos.update', $movimiento->idMovimiento) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ $movimiento->fecha }}" required>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $movimiento->cantidad }}" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $movimiento->precio }}" required>
            </div>
            <div class="form-group">
                <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ $movimiento->numRemisionProveedor }}">
            </div>
            <div class="form-group">
                <label for="observacion">Observación</label>
                <textarea class="form-control" id="observacion" name="observacion">{{ $movimiento->observacion }}</textarea>
            </div>
            <div class="form-group">
                <label for="firma">Firma</label>
                <input type="text" class="form-control" id="firma" name="firma" value="{{ $movimiento->firma }}" required>
            </div>
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ $movimiento->proveedor }}" required>
            </div>
            <div class="form-group">
                <label for="colaborador">Colaborador</label>
                <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ $movimiento->colaborador }}" required>
            </div>
            <div class="form-group">
                <label for="usuarios_id">ID Usuario</label>
                <input type="number" class="form-control" id="usuarios_id" name="usuarios_id" value="{{ $movimiento->usuarios_id }}" required>
            </div>
            <div class="form-group">
                <label for="items_id">ID Item</label>
                <input type="number" class="form-control" id="items_id" name="items_id" value="{{ $movimiento->items_id }}" required>
            </div>
            <div class="form-group">
                <label for="tipoMovimientos_id">ID Tipo Movimiento</label>
                <input type="number" class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" value="{{ $movimiento->tipoMovimientos_id }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
