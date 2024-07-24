@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">

        <h1 class="my-4">Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mb-4">Crear Usuario</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->idUsuario }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->cargo }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->nombre }}</td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario->idUsuario) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                            <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
