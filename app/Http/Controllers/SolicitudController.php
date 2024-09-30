<?php
namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TipoMantenimiento;
use App\Models\Estado;
use App\Models\Trabajador;
use App\Models\SolicitudHasTrabajador;
use App\Models\Area;
use App\Models\Item;
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

        // dd($solicitudes);
    
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

        $repuestos = Item::where('idItem', $solicitud->repuestosUtilizados)->first();

        $solicitud->repuestosUtilizados = $repuestos->nombre;
        $solicitud->totalHorasTrabajadas = str_replace('.',':',strval($solicitud->totalHorasTrabajadas));
        $solicitud->tiempoParada = str_replace('.',':',strval($solicitud->tiempoParada)); 
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
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'fecha' => 'required|date',
                'tiempoEstimado' => 'nullable|string|max:45',
                'tipoMantenimientos_id' => 'required|exists:Tipomantenimientos,idTipomantenimiento',
                'fechaInicio' => 'nullable|date',
                'fechaTermina' => 'nullable|date',
                'mantenimientoEficiente' => 'required|boolean',
                'totalHorasTrabajadas' => 'nullable|string',
                'tiempoParada' => 'nullable|string',
                'repuestosSeleccionados' => 'required',
                'trabajadoresSeleccionados' => 'required',
                'observaciones' => 'nullable|string',
                'firmaDirector' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'firmaGerente' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'firmaLider' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estados_id' => 'required|exists:Estados,idEstado',
                'areas_id' => 'required|exists:Areas,idArea',
            ]);

            $rutaFirmaDirector = null;
            $rutaFirmaGerente = null;
            $rutaFirmaLider = null;

            // Si el archivo existe, lo guardamos y obtenemos su ruta
            if ($request->hasFile('firmaDirector')) {
                $rutaFirmaDirector = $request->file('firmaDirector')->store('firmas', 'public');
            }

            if ($request->hasFile('firmaGerente')) {
                $rutaFirmaGerente = $request->file('firmaGerente')->store('firmas', 'public');
            }

            if ($request->hasFile('firmaLider')) {
                $rutaFirmaLider = $request->file('firmaLider')->store('firmas', 'public');
            }
        
            // Crear la solicitud
            $solicitud = new Solicitud();
            $solicitud->fecha = $validatedData['fecha'];
            $solicitud->descripcionFalla = 'N/A';
            $solicitud->tipoMantenimientos_id = $validatedData['tipoMantenimientos_id'];
            $solicitud->tiempoEstimado = $validatedData['tiempoEstimado'];
            $solicitud->fechaInicio = $validatedData['fechaInicio'] ?? null;
            $solicitud->fechaTermina = $validatedData['fechaTermina'];
            $solicitud->mantenimientoEficiente = $validatedData['mantenimientoEficiente'];
            $solicitud->totalHorasTrabajadas = floatval(str_replace(':', '.', $validatedData['totalHorasTrabajadas']));
            $solicitud->tiempoParada = floatval(str_replace(':', '.', $validatedData['tiempoParada']));
            $solicitud->repuestosUtilizados = implode(', ', $validatedData['repuestosSeleccionados']);
            $solicitud->trabajadoresAsignados = implode(', ', $validatedData['trabajadoresSeleccionados']);
            $solicitud->observaciones = $validatedData['observaciones'] ?? null;
            $solicitud->firmaDirector = $rutaFirmaDirector;
            $solicitud->firmaGerente = $rutaFirmaGerente;
            $solicitud->firmaLider = $rutaFirmaLider;
            $solicitud->estados_id = $validatedData['estados_id'];
            $solicitud->areas_id = $validatedData['areas_id'];
            $solicitud->save();
        
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada exitosamente.');
        } catch (\Exception $e) {
            \Log::alert($e);
            // Manejar el error y redirigir
            return redirect()->back()->with('error', 'Ocurrió un error al crear el movimiento. Por favor, inténtalo de nuevo.');
        }
    }
    

    public function edit($id)
    {
        $solicitude = Solicitud::findOrFail($id);
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::whereIn('nombre', ['Aprobado', 'No Aprobado'])->get();
        $areas = Area::all();
        $trabajadores = Trabajador::all();
        $solicitudHasTrabajador = SolicitudHasTrabajador::where('solicitudes_id', $id)->first();
    
        $repuestos = Item::where('idItem', $solicitude->repuestosUtilizados)->first();

        $solicitude->repuestosUtilizados = $repuestos->nombre;
        $solicitude->totalHorasTrabajadas = str_replace('.',':',strval($solicitude->totalHorasTrabajadas));
        $solicitude->tiempoParada = str_replace('.',':',strval($solicitude->tiempoParada)); 
        
        return view('solicitudes.edit', compact('solicitude', 'tiposMantenimientos', 'estados', 'areas', 'trabajadores', 'solicitudHasTrabajador'));
    }
    
    public function update(Request $request, $id)
{
    try {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'tiempoEstimado' => 'nullable|string|max:45',
            'tipoMantenimientos_id' => 'required|exists:Tipomantenimientos,idTipomantenimiento',
            'fechaInicio' => 'nullable|date',
            'fechaTermina' => 'nullable|date',
            'mantenimientoEficiente' => 'required|boolean',
            'totalHorasTrabajadas' => 'nullable|string',
            'tiempoParada' => 'nullable|string',
            // 'repuestosSeleccionados' => 'required',
            // 'trabajadoresSeleccionados' => 'required',
            'observaciones' => 'nullable|string',
            'firmaDirector' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'firmaGerente' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'firmaLider' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estados_id' => 'required|exists:Estados,idEstado',
            'areas_id' => 'required|exists:Areas,idArea',
        ]);

        // Obtener la solicitud existente
        $solicitud = Solicitud::findOrFail($id);

        // Variables para las firmas
        $rutaFirmaDirector = $solicitud->firmaDirector;
        $rutaFirmaGerente = $solicitud->firmaGerente;
        $rutaFirmaLider = $solicitud->firmaLider;

        // Si se suben nuevas firmas, guardarlas y obtener sus rutas
        if ($request->hasFile('firmaDirector')) {
            $rutaFirmaDirector = $request->file('firmaDirector')->store('firmas', 'public');
        }

        if ($request->hasFile('firmaGerente')) {
            $rutaFirmaGerente = $request->file('firmaGerente')->store('firmas', 'public');
        }

        if ($request->hasFile('firmaLider')) {
            $rutaFirmaLider = $request->file('firmaLider')->store('firmas', 'public');
        }
        
        // Actualizar los campos de la solicitud
        $solicitud->fecha = $validatedData['fecha'];
        $solicitud->descripcionFalla = 'N/A'; // O dejar como estaba si es necesario
        $solicitud->tipoMantenimientos_id = $validatedData['tipoMantenimientos_id'];
        $solicitud->tiempoEstimado = $validatedData['tiempoEstimado'];
        $solicitud->fechaInicio = $validatedData['fechaInicio'] ?? null;
        $solicitud->fechaTermina = $validatedData['fechaTermina'];
        $solicitud->mantenimientoEficiente = $validatedData['mantenimientoEficiente'];
        $solicitud->totalHorasTrabajadas = floatval(str_replace(':', '.', $validatedData['totalHorasTrabajadas']));
        $solicitud->tiempoParada = floatval(str_replace(':', '.', $validatedData['tiempoParada']));
        // $solicitud->repuestosUtilizados = implode(', ', $validatedData['repuestosSeleccionados']);
        // $solicitud->trabajadoresAsignados = implode(', ', $validatedData['trabajadoresSeleccionados']);
        $solicitud->observaciones = $validatedData['observaciones'] ?? null;
        $solicitud->firmaDirector = $rutaFirmaDirector;
        $solicitud->firmaGerente = $rutaFirmaGerente;
        $solicitud->firmaLider = $rutaFirmaLider;
        $solicitud->estados_id = $validatedData['estados_id'];
        $solicitud->areas_id = $validatedData['areas_id'];
        
        // Guardar los cambios
        $solicitud->save();

        // Redirigir a una página de éxito o mostrar un mensaje de éxito
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente.');
    } catch (\Exception $e) {
        \Log::alert($e);
        // Manejar el error y redirigir
        return redirect()->back()->with('error', 'Ocurrió un error al actualizar la solicitud. Por favor, inténtalo de nuevo.');
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
