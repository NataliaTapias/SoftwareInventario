<?php

// app/Http/Controllers/SubcategoriaController.php
namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')->get();
        return view('subcategorias.index', compact('subcategorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('subcategorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'categorias_id' => 'required|exists:categorias,idCategoria'
        ]);

        Subcategoria::create($request->all());
        return redirect()->route('subcategorias.index');
    }

    public function show(Subcategoria $subcategoria)
    {
        return view('subcategorias.show', compact('subcategoria'));
    }

    public function edit(Subcategoria $subcategoria)
    {
        $categorias = Categoria::all();
        return view('subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    public function update(Request $request, Subcategoria $subcategoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'categorias_id' => 'required|exists:categorias,idCategoria'
        ]);

        $subcategoria->update($request->all());
        return redirect()->route('subcategorias.index');
    }

    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();
        return redirect()->route('subcategorias.index');
    }
}

