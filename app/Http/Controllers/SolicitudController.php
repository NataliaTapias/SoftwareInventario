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

    public function show($id)
    {
        if (request()->has('query')) {
            $query = request()->input('query');
            $solicitudes = Solicitud::where('descripcionFalla', 'LIKE', "%{$query}%")->get();
            return response()->json($solicitudes);
        }

        $solicitud = Solicitud::findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    public function create()
    {
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::whereIn('nombre', ['Aprobado', 'No Aprobado'])->get();
        $areas = Area::all();
    
        return view('solicitudes.create', compact('tiposMantenimientos', 'estados', 'areas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:Tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'required|boolean',
            'totalHorasTrabajadas' => 'nullable|numeric',
            'tiempoParada' => 'nullable|numeric',
            'repuestosUtilizados' => 'nullable|json',
            'trabajadoresAsignados' => 'nullable|json',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|string|max:255',
            'firmaGerente' => 'nullable|string|max:255',
            'firmaLider' => 'nullable|string|max:255',
            'estados_id' => 'required|exists:Estados,idEstado',
            'areas_id' => 'required|exists:Areas,idArea',
        ]);
    
        // Crear la solicitud
        $solicitud = new Solicitud();
        $solicitud->fecha = $validatedData['fecha'];
        $solicitud->descripcionFalla = $validatedData['descripcionFalla'];
        $solicitud->tiempoEstimado = $validatedData['tiempoEstimado'];
        $solicitud->tipoMantenimientos_id = $validatedData['tipoMantenimientos_id'];
        $solicitud->fechaInicio = $validatedData['fechaInicio'];
        $solicitud->fechaTermina = $validatedData['fechaTermina'];
        $solicitud->mantenimientoEficiente = $validatedData['mantenimientoEficiente'];
        $solicitud->totalHorasTrabajadas = $validatedData['totalHorasTrabajadas'];
        $solicitud->tiempoParada = $validatedData['tiempoParada'];
        $solicitud->repuestosUtilizados = $validatedData['repuestosUtilizados'];
        $solicitud->trabajadoresAsignados = $validatedData['trabajadoresAsignados'];
        $solicitud->observaciones = $validatedData['observaciones'];
        $solicitud->firmaDirector = $validatedData['firmaDirector'];
        $solicitud->firmaGerente = $validatedData['firmaGerente'];
        $solicitud->firmaLider = $validatedData['firmaLider'];
        $solicitud->estados_id = $validatedData['estados_id'];
        $solicitud->areas_id = $validatedData['areas_id'];
        $solicitud->save();
    
        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
    }
    

    public function edit($id)
    {
        $solicitude = Solicitud::findOrFail($id);
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::whereIn('nombre', ['Aprobado', 'No Aprobado'])->get();
        $areas = Area::all();
        $trabajadores = Trabajador::all();
        $solicitudHasTrabajador = SolicitudHasTrabajador::where('solicitudes_id', $id)->first();
    
        return view('solicitudes.edit', compact('solicitude', 'tiposMantenimientos', 'estados', 'areas', 'trabajadores', 'solicitudHasTrabajador'));
    }
    
    public function update(Request $request, Solicitud $solicitude)
    {
        $request->merge(['mantenimientoEficiente' => $request->has('mantenimientoEficiente')]);
    
        $request->validate([
            'fecha' => 'required|date',
            'descripcionFalla' => 'required|string',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'required|boolean',
            'totalHorasTrabajadas' => 'nullable|numeric|min:0',
            'tiempoParada' => 'nullable|numeric|min:0',
            'repuestosUtilizados' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|string|max:255',
            'firmaGerente' => 'nullable|string|max:255',
            'firmaLider' => 'nullable|string|max:255',
            'estados_id' => 'required|exists:estados,idEstado',
            'areas_id' => 'required|exists:areas,idArea',
            'trabajadores_id' => 'nullable|integer|exists:trabajadores,idTrabajador'
        ]);

        try {
            $solicitude->update($request->all());
    
            if ($request->filled('trabajadores_id')) {
                SolicitudHasTrabajador::updateOrCreate(
                    ['solicitudes_id' => $solicitude->idSolicitud],
                    [
                        'soli_tipoMantenimientos_id' => $request->tipoMantenimientos_id,
                        'solicitudes_estados_id' => $request->estados_id,
                        'trabajadores_id' => $request->trabajadores_id
                    ]
                );
            }
    
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar la solicitud: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Solicitud $solicitude)
    {
        try {
            $solicitude->delete();
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar la solicitud: ' . $e->getMessage());
        }
    }
}
