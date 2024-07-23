<?php
namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TipoMantenimiento;
use App\Models\Estado;
use App\Models\Trabajador;
use App\Models\SolicitudHasTrabajador;
use App\Models\Area;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $estadoId = $request->query('estado_id');
        $fechaInicio = $request->query('fecha_inicio');
        $fechaFin = $request->query('fecha_fin');
    
        $solicitudes = Solicitud::with(['tipoMantenimiento', 'estado', 'area'])
            ->when($search, function ($query, $search) {
                return $query->where('descripcionFalla', 'like', '%' . $search . '%')
                    ->orWhere('observaciones', 'like', '%' . $search . '%');
            })
            ->when($estadoId, function ($query, $estadoId) {
                return $query->where('estado_id', $estadoId);
            })
            ->when($fechaInicio, function ($query, $fechaInicio) {
                return $query->where('created_at', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query, $fechaFin) {
                return $query->where('created_at', '<=', $fechaFin);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        $estados = Estado::all();
        $areas = Area::all();
    
        return view('solicitudes.index', compact('solicitudes', 'estados', 'areas'));
    }
    
    


    


// SolicitudController.php

public function show($id)
{
    // Check if the request is a search query
    if (request()->has('query')) {
        $query = request()->input('query');
        $solicitudes = Solicitud::where('descripcionFalla', 'LIKE', "%{$query}%")->get();
        return response()->json($solicitudes);
    }

    // If not a search query, proceed with the normal show functionality
    $solicitud = Solicitud::findOrFail($id);
    return view('solicitudes.show', compact('solicitud'));
}



    public function create()
    {
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::all();
        $areas = Area::all();
    
        return view('solicitudes.create', compact('tiposMantenimientos', 'estados', 'areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:tipomantenimientos,idTipomantenimiento',
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
            'estados_id' => 'required|exists:estados,idEstado',
            'areas_id' => 'required|exists:areas,idArea',
        ]);
    
        $solicitud = Solicitud::create($request->all());
    
        if ($request->has('asignar_trabajador')) {
            return redirect()->route('solicitudes_has_trabajadores.create', ['solicitud_id' => $solicitud->idSolicitud]);
        }

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
    }

    public function edit($id)
    {
        $solicitude = Solicitud::findOrFail($id);
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::all();
        $areas = Area::all();
        $trabajadores = Trabajador::all();
        $solicitudHasTrabajador = SolicitudHasTrabajador::where('solicitudes_id', $id)->first();
    
        return view('solicitudes.edit', compact('solicitude', 'tiposMantenimientos', 'estados', 'areas', 'trabajadores', 'solicitudHasTrabajador'));
    }
    

    public function update(Request $request, Solicitud $solicitude)
    {
        // Asegurarse de que mantenimientoEficiente esté presente y sea booleano
        $request->merge(['mantenimientoEficiente' => $request->has('mantenimientoEficiente')]);
    
        // Validación de datos
        $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'required|boolean', // Validación como booleano
            'totalHorasTrabajadas' => 'nullable|numeric|min:0',
            'tiempoParada' => 'nullable|numeric|min:0',
            'repuestosUtilizados' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|string|max:255',
            'firmaGerente' => 'nullable|string|max:255',
            'firmaLider' => 'nullable|string|max:255',
            'estados_id' => 'required|exists:estados,idEstado',
            'areas_id' => 'required|exists:areas,idArea',
            'trabajadores_id' => 'nullable|integer|exists:trabajadores,idTrabajador' // Añadido para la asignación opcional de trabajador
        ]);
    
        // Actualizar solicitud
        $solicitude->update($request->all());
    
        // Asignación del trabajador si se proporciona
        if ($request->filled('trabajadores_id')) {
            SolicitudHasTrabajador::updateOrCreate(
                ['solicitudes_id' => $solicitude->id],
                [
                    'soli_tipoMantenimientos_id' => $request->tipoMantenimientos_id,
                    'solicitudes_estados_id' => $request->estados_id,
                    'trabajadores_id' => $request->trabajadores_id
                ]
            );
        }
    
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy(Solicitud $solicitude)
    {
        $solicitude->delete();
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito');
    }
}
