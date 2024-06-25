@extends('layouts.app')

@section('title', 'Tipos de Movimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Tipos de Movimiento</h1>
        <a href="{{ route('tipomovimientos.create') }}" class="btn btn-success mb-4">Crear Tipo de Movimiento</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipomovimientos as $tipomovimiento)
                    <tr>
                        <td>{{ $tipomovimiento->idTipomovimiento }}</td>
                        <td>{{ $tipomovimiento->nombre }}</td>
                        <td>
                            <a href="{{ route('tipomovimientos.edit', $tipomovimiento->idTipomovimiento) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('tipomovimientos.destroy', $tipomovimiento->idTipomovimiento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tipo de movimiento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
