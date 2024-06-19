@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Categoria</h1>

        <form method="POST" action="{{ route('categorias.update', $categoria->idCategoria) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
