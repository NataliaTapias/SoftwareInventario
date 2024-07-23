@extends('layouts.app')

@section('title', 'Crear Ítem')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('items.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Crear Ítem</h1>
    </div>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="referencia">Referencia</label>
                    <input type="text" name="referencia" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="unidadMedida">Unidad de Medida</label>
                    <input type="text" name="unidadMedida" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cantidadMinima">Cantidad Mínima</label>
                    <input type="number" name="cantidadMinima" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="subcategorias_id">Subcategoría</label>
                    <select name="subcategorias_id" class="form-control" required>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->idSubcategoria }}">{{ $subcategoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="estados_id">Estado</label>
                    <select name="estados_id" class="form-control" required>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->idEstado }}">{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
