@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="container">
        <h1 class="my-4">Roles</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-success mb-4">Crear Rol</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $rol)
    <tr>
        <td>{{ $rol->idRol }}</td>
        <td>{{ $rol->nombre }}</td>
        <td>
        <a href="{{ route('roles.edit', $rol->idRol) }}" class="btn btn-warning btn-sm">Editar</a>

            <form action="{{ route('roles.destroy', $rol->idRol) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este rol?');">
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
