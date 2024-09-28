<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use Illuminate\Http\Request;

class TipoMovimientoController extends Controller
{
    public function index()
    {
        $tipomovimientos = TipoMovimiento::all();
        return view('tipomovimientos.index', compact('tipomovimientos'));
    }

    public function create()
    {
        return view('tipomovimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'Operacion' => 'required|in:0,1',
        ]);

        TipoMovimiento::create($request->all());
        return redirect()->route('tipomovimientos.index');
    }

    public function edit(TipoMovimiento $tipomovimiento)
    {
        return view('tipomovimientos.edit', compact('tipomovimiento'));
    }

    public function update(Request $request, TipoMovimiento $tipomovimiento)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'Operacion' => 'required|in:0,1',
        ]);

        $tipomovimiento->update($request->all());

        return redirect()->route('tipomovimientos.index');
    }

    public function destroy(TipoMovimiento $tipomovimiento)
    {
        $tipomovimiento->delete();
        return redirect()->route('tipomovimientos.index');
    }
}
