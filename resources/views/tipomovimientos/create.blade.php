@extends('layouts.app')

@section('title', 'Crear Tipo de Movimiento')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Tipo de Movimiento</h1>
        <form action="{{ route('tipomovimientos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
