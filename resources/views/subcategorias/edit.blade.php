@extends('layouts.app')

@section('title', 'Editar Subcategoría')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Subcategoría</h1>

        <form method="POST" action="{{ route('subcategorias.update', $subcategoria->idSubcategoria) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $subcategoria->nombre) }}" required>
            </div>
            <div class="form-group">
                <label for="categorias_id">Categoría</label>
                <select class="form-control" id="categorias_id" name="categorias_id" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->idCategoria }}" {{ $subcategoria->categorias_id == $categoria->idCategoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('subcategorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
