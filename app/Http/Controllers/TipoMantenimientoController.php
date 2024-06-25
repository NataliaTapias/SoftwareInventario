<?php

namespace App\Http\Controllers;

use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;

class TipoMantenimientoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = TipoMantenimiento::query();
        
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }
        
        $tipomantenimientos = $query->get();
        return view('tipomantenimientos.index', compact('tipomantenimientos'));
    }

    public function create()
    {
        return view('tipomantenimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:80',
        ]);

        TipoMantenimiento::create($request->all());
        return redirect()->route('tipomantenimientos.index')->with('success', 'Tipo de Mantenimiento creado con éxito');
    }

    public function edit(TipoMantenimiento $tipomantenimiento)
    {
        return view('tipomantenimientos.edit', compact('tipomantenimiento'));
    }

    public function update(Request $request, TipoMantenimiento $tipomantenimiento)
    {
        $request->validate([
            'nombre' => 'required|string|max:80',
        ]);

        $tipomantenimiento->update($request->all());
        return redirect()->route('tipomantenimientos.index')->with('success', 'Tipo de Mantenimiento actualizado con éxito');
    }

    public function destroy(TipoMantenimiento $tipomantenimiento)
    {
        $tipomantenimiento->delete();
        return redirect()->route('tipomantenimientos.index')->with('success', 'Tipo de Mantenimiento eliminado con éxito');
    }
}
