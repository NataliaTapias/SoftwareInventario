@extends('layouts.app')

@section('title', 'Editar Subcategoría')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('subcategorias.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Subcategoria</h1>
    </div>
        <form method="POST" action="{{ route('subcategorias.update', $subcategoria->idSubcategoria) }}" class="col-md-6 mx-auto">
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
            <div class="text-center">
                 <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
