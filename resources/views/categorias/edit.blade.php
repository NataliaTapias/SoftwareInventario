@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('categorias.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Editar Categoría</h1>
    </div>

    <form method="POST" action="{{ route('categorias.update', $categoria->idCategoria) }}" class="col-md-6 mx-auto">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>
@endsection
