<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TipoMantenimiento;
use App\Models\Estado;
use App\Models\Area;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with(['tipoMantenimiento', 'estado', 'area'])->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        $tipoMantenimientos = TipoMantenimiento::all();
        $estados = Estado::all();
        $areas = Area::all();
    
        return view('solicitudes.create', compact('tipoMantenimientos', 'estados', 'areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:Tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'nullable|boolean',
            'totalHorasTrabajadas' => 'nullable|numeric|min:0',
            'tiempoParada' => 'nullable|numeric|min:0',
            'repuestosUtilizados' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|string|max:255',
            'firmaGerente' => 'nullable|string|max:255',
            'firmaLider' => 'nullable|string|max:255',
            'estados_id' => 'required|exists:Estados,idEstado',
            'areas_id' => 'required|exists:Areas,idArea',
        ]);
    
        Solicitud::create($request->all());
    
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
    }

    public function edit(Solicitud $solicitud)
    {
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::all();
        $areas = Area::all();
        return view('solicitudes.edit', compact('solicitud', 'tiposMantenimientos', 'estados', 'areas'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:Tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'nullable|boolean',
            'totalHorasTrabajadas' => 'nullable|numeric|min:0',
            'tiempoParada' => 'nullable|numeric|min:0',
            'repuestosUtilizados' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|string|max:255',
            'firmaGerente' => 'nullable|string|max:255',
            'firmaLider' => 'nullable|string|max:255',
            'estados_id' => 'required|exists:Estados,idEstado',
            'areas_id' => 'required|exists:Areas,idArea',
        ]);

        $solicitud->update($request->all());
    
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
    }
}
