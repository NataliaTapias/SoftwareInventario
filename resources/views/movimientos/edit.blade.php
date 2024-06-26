@extends('layouts.app')

@section('title', 'Editar Movimiento')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Movimiento</h1>

    <form method="POST" action="{{ route('movimientos.update', $movimiento->idMovimiento) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col">
                        <label for="fecha">Fecha</label>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ \Carbon\Carbon::parse($movimiento->fecha)->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <div class="col">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $movimiento->cantidad }}" required>
                    </div>
                    <div class="col">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $movimiento->precio }}" required>
                    </div>
                    <div class="col">
                        <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                        <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ $movimiento->numRemisionProveedor }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col">
                        <label for="firma">Firma</label>
                        <input type="text" class="form-control" id="firma" name="firma" value="{{ $movimiento->firma }}" required>
                    </div>
                    <div class="col">
                        <label for="colaborador">Colaborador</label>
                        <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ $movimiento->colaborador }}" required>
                    </div>
                    <div class="col">
                        <label for="usuarios_id">Usuario</label>
                        <select class="form-control" id="usuarios_id" name="usuarios_id" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->idUsuario }}" {{ $movimiento->usuarios_id == $usuario->idUsuario ? 'selected' : '' }}>{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="solicitudes_id">Solicitud</label>
                        <select class="form-control" id="solicitudes_id" name="solicitudes_id" required>
                            @foreach($solicitudes as $solicitud)
                                <option value="{{ $solicitud->idSolicitud }}" {{ $movimiento->solicitudes_id == $solicitud->idSolicitud ? 'selected' : '' }}>{{ $solicitud->descripcionFalla }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="items_id">Item</label>
            <select class="form-control" id="items_id" name="items_id" required>
                @foreach($items as $item)
                    <option value="{{ $item->idItem }}" {{ $movimiento->items_id == $item->idItem ? 'selected' : '' }}>{{ $item->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tipoMovimientos_id">Tipo de Movimiento</label>
            <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" required>
                @foreach($tipoMovimientos as $tipoMovimiento)
                    <option value="{{ $tipoMovimiento->idTipomovimiento }}" {{ $movimiento->tipoMovimientos_id == $tipoMovimiento->idTipomovimiento ? 'selected' : '' }}>{{ $tipoMovimiento->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="observacion">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion">{{ $movimiento->observacion }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
