@extends('layouts.app')

@section('title', 'Crear Subcategoría')

@section('content')
    <div class="container">
        <h1 class="my-4">Crear Subcategoría</h1>

        <form method="POST" action="{{ route('subcategorias.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="categorias_id">Categoría</label>
                <select class="form-control" id="categorias_id" name="categorias_id" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('subcategorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
