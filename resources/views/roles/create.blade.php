@extends('layouts.app')

@section('title', 'Crear Rol')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <a href="{{ route('roles.index') }}" class="icon-link" title="Atrás">
            <i class="fa-solid fa-circle-left"></i>
        </a>
        <h1>Crear Rol</h1>
    </div>

    <form method="POST" action="{{ route('roles.store') }}" class="col-md-6 mx-auto">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
@endsection
