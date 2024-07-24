<!-- resources/views/tipomantenimientos/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Editar Tipo de Mantenimiento')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('tipomantenimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Tipo de Mantenimiento</h1>
    </div>
        <form method="POST" action="{{ route('tipomantenimientos.update', $tipomantenimiento->idTipomantenimiento) }}" class="col-md-6 mx-auto">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tipomantenimiento->nombre }}" required>
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection
