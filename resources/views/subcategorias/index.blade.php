@extends('layouts.app')

@section('title', 'Subcategorías')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Subcategorías</h1>
    <div class="mb-3">
        <a href="{{ route('subcategorias.create') }}" class="btn btn-success">Crear Subcategoría</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategorias as $subcategoria)
                <tr>
                    <td>{{ $subcategoria->idSubcategoria }}</td>
                    <td>{{ $subcategoria->nombre }}</td>
                    <td>{{ $subcategoria->categoria->nombre }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('subcategorias.edit', $subcategoria->idSubcategoria) }}" class="btn btn-warning btn-sm mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('subcategorias.destroy', $subcategoria->idSubcategoria) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta subcategoría?');">
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
