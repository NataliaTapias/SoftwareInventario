@extends('layouts.app')

@section('title', 'Crear Estado')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Estado</h1>

        <form method="POST" action="{{ route('estados.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('estados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
