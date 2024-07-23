@extends('layouts.app')

@section('title', 'Editar Ítem')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Editar Ítem</h1>
    <form action="{{ route('items.update', $item->idItem) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="referencia">Referencia</label>
                    <input type="text" name="referencia" class="form-control" value="{{ $item->referencia }}" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $item->nombre }}" required>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" value="{{ $item->cantidad }}" required>
                </div>
                <div class="form-group">
                    <label for="unidadMedida">Unidad de Medida</label>
                    <input type="text" name="unidadMedida" class="form-control" value="{{ $item->unidadMedida }}" required>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label for="cantidadMinima">Cantidad Mínima</label>
                    <input type="number" name="cantidadMinima" class="form-control" value="{{ $item->cantidadMinima }}" required>
                </div>
                <div class="form-group">
                    <label for="subcategorias_id">Subcategoría</label>
                    <select name="subcategorias_id" class="form-control" required>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->idSubcategoria }}" {{ $subcategoria->idSubcategoria == $item->subcategorias_id ? 'selected' : '' }}>
                                {{ $subcategoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="estados_id">Estado</label>
                    <select name="estados_id" class="form-control" required>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->idEstado }}" {{ $estado->idEstado == $item->estados_id ? 'selected' : '' }}>
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $item->descripcion }}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
