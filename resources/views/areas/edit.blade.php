@extends('layouts.app')

@section('title', 'Editar Área')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Área</h1>

        <form method="POST" action="{{ route('areas.update', $area->idArea) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $area->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('areas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
