<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado; 


class EstadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $estados = Estado::when($search, function ($query, $search) {
            return $query->where('nombre', 'like', '%'.$search.'%')
                         ->orWhere('tipo', 'like', '%'.$search.'%');
        })->get();
    
        return view('estados.index', compact('estados'));
    }
    

    public function create()
    {
        return view('estados.create');
    }

    public function store(Request $request)
    {
        // Valida y guarda el estado
        $estado = new Estado();
        $estado->nombre = $request->input('nombre');
        $estado->tipo = $request->input('tipo');
        $estado->save();

        return redirect()->route('estados.index');
    }

    public function edit($idEstado)
    {
        $estado = Estado::findOrFail($idEstado);
        return view('estados.edit', compact('estado'));
    }

    public function update(Request $request, $idEstado)
    {
        $estado = Estado::findOrFail($idEstado);
        $estado->nombre = $request->input('nombre');
        $estado->tipo = $request->input('tipo');
        $estado->save();

        return redirect()->route('estados.index');
    }

    public function destroy($idEstado)
    {
        $estado = Estado::findOrFail($idEstado);
        $estado->delete();

        return redirect()->route('estados.index');
    }
}
