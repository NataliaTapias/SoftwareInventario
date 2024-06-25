<!-- resources/views/trabajadores/create.blade.php -->

@extends('layouts.app')

@section('title', 'Crear Trabajador')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Trabajador</h1>

        <form method="POST" action="{{ route('trabajadores.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del trabajador" required>
            </div>
            <!-- Otros campos del trabajador que necesites -->

            <button type="submit" class="btn btn-primary">Crear Trabajador</button>
            <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
