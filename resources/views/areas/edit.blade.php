@extends('layouts.app')

@section('title', 'Editar Área')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" >
        <a href="{{ route('areas.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i> <!-- Ícono de Font Awesome -->
        </a>
        <h1>Editar Área</h1>
    </div>

    <form method="POST" action="{{ route('areas.update', $area->idArea) }}" class="col-md-6 mx-auto">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $area->nombre }}" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>
@endsection

