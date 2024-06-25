<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Trabajador::query();
        
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }
        
        $trabajadores = $query->get();
        return view('trabajadores.index', compact('trabajadores'));
    }

    public function create()
    {
        return view('trabajadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
        ]);

        Trabajador::create($request->all());
        return redirect()->route('trabajadores.index')->with('success', 'Trabajador creado con éxito');
    }

    public function edit(Trabajador $trabajadore)
    {
        return view('trabajadores.edit', compact('trabajadore'));
    }

    public function update(Request $request, Trabajador $trabajadore)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
        ]);

        $trabajadore->update($request->all());
        return redirect()->route('trabajadores.index')->with('success', 'Trabajador actualizado con éxito');
    }

    public function destroy(Trabajador $trabajadore)
    {
        $trabajadore->delete();
        return redirect()->route('trabajadores.index')->with('success', 'Trabajador eliminado con éxito');
    }
}
