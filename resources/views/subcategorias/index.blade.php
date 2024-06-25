@extends('layouts.app')

@section('title', 'Subcategorías')

@section('content')
    <div class="container">
        <h1 class="my-4">Subcategorías</h1>
        <a href="{{ route('subcategorias.create') }}" class="btn btn-success mb-4">Crear Subcategoría</a>
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
                            <a href="{{ route('subcategorias.edit', $subcategoria->idSubcategoria) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('subcategorias.destroy', $subcategoria->idSubcategoria) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta subcategoría?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
