@extends('layouts.app')

@section('title', 'Editar Rol')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Rol</h1>

        <form method="POST" action="{{ route('roles.update', $rol->idRol) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $rol->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
