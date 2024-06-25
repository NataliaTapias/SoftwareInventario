<!-- resources/views/tipomantenimientos/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Tipo de Mantenimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Tipo de Mantenimiento</h1>

        <form method="POST" action="{{ route('tipomantenimientos.update', $tipomantenimiento->idTipomantenimiento) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tipomantenimiento->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Tipo de Mantenimiento</button>
            <a href="{{ route('tipomantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
