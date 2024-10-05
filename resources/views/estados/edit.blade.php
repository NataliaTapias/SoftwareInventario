@extends('layouts.app')

@section('title', 'Editar Estado')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('estados.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Editar Estado</h1>
    </div>

    <form method="POST" action="{{ route('estados.update', $estado->idEstado) }}" class="col-md-6 mx-auto">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $estado->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo</option>
                <option value="item" {{$estado->tipo == 'item' ? 'selected' : ''}}>item</option>
                <option value="solicitud" {{$estado->tipo == 'solicitud' ? 'selected' : ''}}>solicitud</option>
            </select>
            {{-- <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $estado->tipo }}" required> --}}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
