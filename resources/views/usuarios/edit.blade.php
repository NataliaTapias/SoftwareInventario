@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Usuario</h1>

        <form method="POST" action="{{ route('usuarios.update', $usuario->idUsuario) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $usuario->cargo }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Deja este campo vacío si no quieres cambiar la contraseña.</small>
            </div>
            <div class="form-group">
                <label for="roles_id">Rol</label>
                <select class="form-control" id="roles_id" name="roles_id" required>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->idRol }}" {{ $usuario->roles_id == $rol->idRol ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
