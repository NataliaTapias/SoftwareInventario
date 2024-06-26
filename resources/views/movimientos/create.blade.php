@extends('layouts.app')

@section('title', 'Crear Movimiento')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Movimiento</h1>

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
                </div>
                <div class="form-group">
                    <label for="numRemisionProveedor">Num Remisión Proveedor</label>
                    <input type="text" class="form-control" id="numRemisionProveedor" name="numRemisionProveedor" value="{{ old('numRemisionProveedor') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observacion">Observación</label>
                    <textarea class="form-control" id="observacion" name="observacion">{{ old('observacion') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="firma">Firma</label>
                    <input type="text" class="form-control" id="firma" name="firma" value="{{ old('firma') }}" required>
                </div>
                <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" class="form-control" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" required>
                </div>
                <div class="form-group">
                    <label for="colaborador">Colaborador</label>
                    <input type="text" class="form-control" id="colaborador" name="colaborador" value="{{ old('colaborador') }}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="usuarios_id">Usuario</label>
            <select class="form-control" id="usuarios_id" name="usuarios_id" required>
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->idUsuario }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="items_id">Item</label>
            <select class="form-control" id="items_id" name="items_id" required>
                <option value="">Seleccione un item</option>
                @foreach($items as $item)
                    <option value="{{ $item->idItem }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="solicitudes_id">Solicitud</label>
            <select class="form-control" id="solicitudes_id" name="solicitudes_id" required>
                <option value="">Seleccione una solicitud</option>
                @foreach($solicitudes as $solicitud)
                    <option value="{{ $solicitud->solicitudes_id }}">{{ $solicitud->descripcionFalla }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tipoMovimientos_id">Tipo de Movimiento</label>
            <select class="form-control" id="tipoMovimientos_id" name="tipoMovimientos_id" required>
                <option value="">Seleccione un tipo de movimiento</option>
                @foreach($tiposMovimientos as $tipoMovimiento)
                    <option value="{{ $tipoMovimiento->idTipomovimiento }}">{{ $tipoMovimiento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('movimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
