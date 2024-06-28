{{-- resources/views/roles/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Listado de Roles')

@section('content')
    <div class="container">
        <h1 class="my-4">Listado de Roles</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-success mb-4">Crear Nuevo Rol</a>

        @if ($roles->isEmpty())
            <div class="alert alert-info">
                No hay roles registrados.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->idRol }}</td>
                            <td>{{ $role->nombre }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('roles.edit', $role->idRol) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('roles.destroy', $role->idRol) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este rol?');">
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
        @endif
    </div>
@endsection
