@extends('layouts.app')

@section('title', 'Crear Categoría')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('categorias.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Crear Categoría</h1>
    </div>

    <form method="POST" action="{{ route('categorias.store') }}" class="col-md-6 mx-auto">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
