@extends('layouts.app')

@section('title', 'Editar Trabajador')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('trabajadores.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar Trabajador</h1>
    </div>
        <form method="POST" action="{{ route('trabajadores.update', $trabajadore->idTrabajador) }}" class="col-md-6 mx-auto">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $trabajadore->nombre }}" required>
            </div>

            <div class="text-center">
                 <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
