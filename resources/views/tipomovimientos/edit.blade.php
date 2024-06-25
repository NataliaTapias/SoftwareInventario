@extends('layouts.app')

@section('title', 'Editar Tipo de Movimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Tipo de Movimiento</h1>

        <form method="POST" action="{{ route('tipomovimientos.update', $tipomovimiento->idTipomovimiento) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $tipomovimiento->nombre) }}" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('tipomovimientos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
