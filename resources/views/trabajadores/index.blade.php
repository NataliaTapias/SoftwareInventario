@extends('layouts.app')

@section('title', 'Trabajadores')

@section('content')
    <div class="container">
        <h1 class="my-4">Trabajadores</h1>
        <a href="{{ route('trabajadores.create') }}" class="btn btn-success mb-4">Crear Trabajador</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabajadores as $trabajador)
                    <tr>
                        <td>{{ $trabajador->idTrabajador }}</td>
                        <td>{{ $trabajador->nombre }}</td>
                        <td>
                            <a href="{{ route('trabajadores.edit', $trabajador->idTrabajador) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('trabajadores.destroy', $trabajador->idTrabajador) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este trabajador?');">
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
