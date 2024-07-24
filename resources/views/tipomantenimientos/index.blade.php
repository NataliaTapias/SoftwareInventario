@extends('layouts.app')

@section('title', 'Tipos de Mantenimiento')

@section('content')
<div class="container-fluid">
        <h1 class="my-4">Tipos de Mantenimiento</h1>
        <a href="{{ route('tipomantenimientos.create') }}" class="btn btn-success mb-4">Crear Tipo de Mantenimiento</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipomantenimientos as $tipomantenimiento)
                        <tr>
                            <td>{{ $tipomantenimiento->idTipomantenimiento }}</td>
                            <td>{{ $tipomantenimiento->nombre }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('tipomantenimientos.edit', $tipomantenimiento->idTipomantenimiento) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tipomantenimientos.destroy', $tipomantenimiento->idTipomantenimiento) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tipo de mantenimiento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
