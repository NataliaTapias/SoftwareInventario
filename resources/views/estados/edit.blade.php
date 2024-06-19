@extends('layouts.app')

@section('title', 'Editar Estado')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Estado</h1>

        <form method="POST" action="{{ route('estados.update', $estado->idEstado) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $estado->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $estado->tipo }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('estados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
