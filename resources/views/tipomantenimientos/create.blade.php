<!-- resources/views/tipomantenimientos/create.blade.php -->

@extends('layouts.app')

@section('title', 'Crear Tipo de Mantenimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Tipo de Mantenimiento</h1>

        <form method="POST" action="{{ route('tipomantenimientos.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del tipo de mantenimiento" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Tipo de Mantenimiento</button>
            <a href="{{ route('tipomantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
