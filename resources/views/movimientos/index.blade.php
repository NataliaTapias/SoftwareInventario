@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
    <div class="container-fluid">
        <h1 class="my-4">Movimientos</h1>

        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('movimientos.index') }}" class="row mb-4">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Buscar por firma o proveedor" value="{{ request('search') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>

        <!-- Botón Crear Movimiento -->
        <div class="mb-4">
            <a href="{{ route('movimientos.create') }}" class="btn btn-success">Crear Movimiento</a>
        </div>

        <!-- Tabla de movimientos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Num Remisión Proveedor</th>
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
                        <td>{{ $movimiento->precio }}</td>
                        <td>{{ $movimiento->numRemisionProveedor }}</td>
                        <td>{{ $movimiento->observacion }}</td>
                        <td>{{ $movimiento->solicitud->nombre ?? 'N/A' }}</td>
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
