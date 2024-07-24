@extends('layouts.app')

@section('title', 'Editar Tipo de Movimiento')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('tipomovimientos.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Editar tipo de Movimiento</h1>
    </div>
        <form method="POST" action="{{ route('tipomovimientos.update', $tipomovimiento->idTipomovimiento) }}" class="col-md-6 mx-auto">
        @csrf
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $tipomovimiento->nombre) }}" required>
            </div>
            <div class="text-center">
                 <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection
