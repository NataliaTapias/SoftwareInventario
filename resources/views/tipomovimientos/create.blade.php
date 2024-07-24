@extends('layouts.app')

@section('title', 'Crear Tipo de Movimiento')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('tipomovimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Crear Tipo de Movimiento</h1>
    </div>
        <form action="{{ route('tipomovimientos.store') }}" method="POST" class="col-md-6 mx-auto">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="text-center">
                 <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
