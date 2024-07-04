@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Movimientos</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('movimientos.index') }}" class="row mb-4">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Buscar por firma, proveedor o observación" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="item_name" class="form-control" placeholder="Buscar por nombre de ítem" value="{{ request('item_name') }}">
            </div>
            <div class="col-md-3">
                <select name="tipoMovimientos_id" class="form-control">
                    <option value="">Filtrar por tipo de movimiento</option>
                    @foreach($tiposMovimientos as $tipoMovimiento)
                        <option value="{{ $tipoMovimiento->idTipomovimiento }}" {{ request('tipoMovimientos_id') == $tipoMovimiento->idTipomovimiento ? 'selected' : '' }}>
                            {{ $tipoMovimiento->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">Buscar</button>
                <a href="{{ route('movimientos.index') }}" class="btn btn-success">Limpiar Filtros</a>
            </div>
        </form>

        <!-- Botón Crear Movimiento -->
        <div class="mb-4">
            <a href="{{ route('movimientos.create') }}" class="btn btn-success">Crear Movimiento</a>
            <a href="{{ route('export.movimientos') }}" class="btn btn-primary">Exportar Movimientos a Excel</a>
        </div>

        <div class="mb-4">


        <!-- Tabla de movimientos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Remisión Proveedor</th>
                    <th>Tipo de Movimiento</th>
                    <th>Observación</th>
                    <th>Solicitud</th>
                    <th>Firma</th>
                    <th>Proveedor</th>
                    <th>Colaborador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->idMovimiento }}</td>
                        <td>{{ $movimiento->fecha }}</td>
                        <td>{{ $movimiento->cantidad }}</td>
                        <td>{{ $movimiento->item->nombre ?? 'N/A' }}</td> <!-- Asumiendo que 'item' es una relación en tu modelo Movimiento -->
                        <td>{{ $movimiento->total }}</td>
                        <td>{{ $movimiento->numRemisionProveedor }}</td>
                        <td>{{ $movimiento->tipoMovimiento->nombre ?? 'N/A'}}</td>                        
                        <td>{{ $movimiento->observacion }}</td>
                        <td>{{ $movimiento->solicitud->descripcionFalla ?? 'N/A' }}</td> <!-- Asumiendo que 'solicitud' es una relación en tu modelo Movimiento -->
                        <td>{{ $movimiento->firma }}</td>
                        <td>{{ $movimiento->proveedor }}</td>
                        <td>{{ $movimiento->colaborador }}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('movimientos.edit', $movimiento->idMovimiento) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('movimientos.destroy', $movimiento->idMovimiento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este movimiento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
