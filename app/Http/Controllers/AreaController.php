<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Area::query();
        
        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }
        
        $areas = $query->get();
        
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
        ]);

        Area::create($request->all());

        return redirect()->route('areas.index')->with('success', 'Área creada con éxito');
    }

    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
        ]);

        $area->update($request->all());

        return redirect()->route('areas.index')->with('success', 'Área actualizada con éxito');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada con éxito');
    }
}
