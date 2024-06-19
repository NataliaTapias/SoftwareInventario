@extends('layouts.app')

@section('title', 'Crear Área')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Área</h1>

        <form method="POST" action="{{ route('areas.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('areas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
