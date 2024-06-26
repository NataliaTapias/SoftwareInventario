<?php

namespace App\Http\Controllers;

use App\Models\SolicitudHasTrabajador;
use App\Models\Solicitud;
use App\Models\TipoMantenimiento;
use App\Models\Estado;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class SolicitudHasTrabajadorController extends Controller
{
    public function index(Request $request)
    {
        $query = SolicitudHasTrabajador::query();
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('solicitud', function($q) use ($search) {
                $q->where('descripcionFalla', 'LIKE', '%' . $search . '%');
            });
        }
    
        $solicitudesHasTrabajadores = $query->get();
    
        return view('solicitudes_has_trabajadores.index', compact('solicitudesHasTrabajadores'));
    }
    

public function create(Request $request)
{
    $solicitud_id = $request->get('solicitud_id');
    $solicitud = Solicitud::find($solicitud_id);

    // Obtener los datos necesarios para el formulario
    $trabajadores = Trabajador::all();
    $tiposMantenimientos = TipoMantenimiento::all();
    $estados = Estado::all();

    return view('solicitudes_has_trabajadores.create', compact('solicitud', 'trabajadores', 'tiposMantenimientos', 'estados'));
}


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'solicitudes_id' => 'required|integer|exists:Solicitudes,idSolicitud',
            'soli_tipoMantenimientos_id' => 'required|integer|exists:TipoMantenimientos,idTipomantenimiento',
            'solicitudes_estados_id' => 'required|integer|exists:Estados,idEstado',
            'trabajadores_id' => 'required|integer|exists:Trabajadores,idTrabajador',
        ]);

        // Crear la nueva asignación
        SolicitudHasTrabajador::create([
            'solicitudes_id' => $request->solicitudes_id,
            'soli_tipoMantenimientos_id' => $request->soli_tipoMantenimientos_id,
            'solicitudes_estados_id' => $request->solicitudes_estados_id,
            'trabajadores_id' => $request->trabajadores_id,
        ]);

        // Redirigir a la página de índice con un mensaje de éxito
        return redirect()->route('solicitudes_has_trabajadores.index')->with('success', 'Solicitud asignada exitosamente.');
    }

    public function showBySolicitud($id)
{
    $solicitud = Solicitud::findOrFail($id);
    $asignaciones = SolicitudHasTrabajador::where('solicitudes_id', $id)->get();

    return view('solicitudes_has_trabajadores.index', compact('solicitud', 'asignaciones'));
}


    public function edit($id)
    {
        $solicitudHasTrabajador = SolicitudHasTrabajador::findOrFail($id);
        $solicitudes = Solicitud::all();
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::all();
        $trabajadores = Trabajador::all();

        return view('solicitudes_has_trabajadores.edit', compact('solicitudHasTrabajador', 'solicitudes', 'tiposMantenimientos', 'estados', 'trabajadores'));
    }

    public function update(Request $request, SolicitudHasTrabajador $solicitudes_has_trabajadore)
    {
        $request->validate([
            'solicitudes_id' => 'required|integer|exists:Solicitudes,idSolicitud',
            'soli_tipoMantenimientos_id' => 'required|integer|exists:TipoMantenimientos,idTipomantenimiento',
            'solicitudes_estados_id' => 'required|integer|exists:Estados,idEstado',
            'trabajadores_id' => 'required|integer|exists:Trabajadores,idTrabajador',
        ]);

        $solicitudes_has_trabajadore->update($request->all());
        return redirect()->route('solicitudes_has_trabajadores.index')->with('success', 'Asignación actualizada con éxito');
    }

    public function destroy(SolicitudHasTrabajador $solicitudes_has_trabajadore)
    {
        $solicitudes_has_trabajadore->delete();
        return redirect()->route('solicitudes_has_trabajadores.index')->with('success', 'Asignación eliminada con éxito');
    }
}
