@extends('layouts.app')

@section('title', 'Editar Trabajador')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Trabajador</h1>

        <form method="POST" action="{{ route('trabajadores.update', $trabajadore->idTrabajador) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $trabajadore->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Trabajador</button>
            <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
