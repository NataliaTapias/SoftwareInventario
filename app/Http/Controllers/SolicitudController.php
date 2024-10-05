<?php
namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TipoMantenimiento;
use App\Models\Estado;
use App\Models\Trabajador;
use App\Models\SolicitudHasTrabajador;
use App\Models\Area;
use App\Models\Item;
use App\Models\Movimiento;
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

        // Dar formato a las fechas con Carbon si son proporcionadas
        $fechaInicioFormatted = $fechaInicio ? Carbon::createFromFormat('Y-m-d', $fechaInicio)->startOfDay() : null;
        $fechaFinFormatted = $fechaFin ? Carbon::createFromFormat('Y-m-d', $fechaFin)->endOfDay() : null;

        $solicitudes = Solicitud::with(['tipoMantenimiento', 'estado', 'area'])
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('descripcionFalla', 'like', '%' . $search . '%')
                        ->orWhere('observaciones', 'like', '%' . $search . '%');
                });
            })
            ->when($estadoId, function ($query, $estadoId) {
                return $query->where('estado_id', $estadoId);
            })
            ->when($fechaInicioFormatted, function ($query, $fechaInicioFormatted) {
                return $query->where('created_at', '>=', $fechaInicioFormatted);
            })
            ->when($fechaFinFormatted, function ($query, $fechaFinFormatted) {
                return $query->where('created_at', '<=', $fechaFinFormatted);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $solicitudes->getCollection()->transform(function($solicitud) {
            // valida que la solicitud no este relacionada a un movimiento
            $esEliminable = Movimiento::where('solicitudes_id', $solicitud->idSolicitud)->first();

            if ($esEliminable == null) {
                $solicitud->eliminable = true;
            } else {
                $solicitud->eliminable = false;
            }

            // Formatear fechas
            $solicitud->fechaInicio = $solicitud->fechaInicio ? Carbon::parse($solicitud->fechaInicio)->format('d/m/Y') : null;
            $solicitud->fechaTermina = $solicitud->fechaTermina ? Carbon::parse($solicitud->fechaTermina)->format('d/m/Y') : null;
        
            // Verificar si el campo repuestosUtilizados tiene contenido
            $repuestosUtilizados = "";
            if (!empty($solicitud->repuestosUtilizados)) {
                // Decodificar el JSON de repuestosUtilizados
                $repuestos = json_decode($solicitud->repuestosUtilizados, true);
        
                // Verificar si la decodificación es exitosa y si es un array
                if (json_last_error() === JSON_ERROR_NONE && is_array($repuestos)) {
                    foreach ($repuestos as $value) {
                        // Validar que los campos 'repuestoNombre' existan en el array
                        if (isset($value['repuestoNombre'])) {
                            $repuestosUtilizados .= $value['repuestoNombre'] . " (" . $value['repuestoCantidad'] . "), ";
                        } else {
                            $repuestosUtilizados .= 'Nombre no disponible ';
                        }
                    }
                } else {
                    // JSON no válido o error de decodificación
                    $repuestosUtilizados = 'Repuestos no disponibles o malformados.';
                }
            } else {
                // El campo está vacío o no contiene datos JSON
                $repuestosUtilizados = 'No se encontraron repuestos.';
            }
        
            // Eliminar la última coma y espacio si la cadena no está vacía
            if (!empty($repuestosUtilizados)) {
                $repuestosUtilizados = rtrim($repuestosUtilizados, ', ');
            }

            // Asignar el valor final al campo repuestosUtilizados
            $solicitud->repuestosUtilizados = $repuestosUtilizados;
        
            return $solicitud;
        });

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

        // $repuestos = Item::where('idItem', $solicitud->repuestosUtilizados)->first();

        $solicitud->totalHorasTrabajadas = str_replace('.',':',strval($solicitud->totalHorasTrabajadas));
        $solicitud->tiempoParada = str_replace('.',':',strval($solicitud->tiempoParada));
        
        $solicitud->trabajadoresAsignados = json_decode($solicitud->trabajadoresAsignados, true);
        return view('solicitudes.show', compact('solicitud'));
    }

    public function create()
    {
        $tiposMantenimientos = TipoMantenimiento::all();
        $estados = Estado::where('tipo', 'solicitud')->get();
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
                'descripcionFalla' => 'nullable|string',
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

            $jsonRepuestos = [];
            for ($i=0; $i < count($request->repuestosSeleccionados); $i++) { 
                $item = Item::where('idItem', $request->repuestosSeleccionados[$i])->first(); // Obtener el primer item
                if ($item) {
                    $jsonRepuestos[] = [
                        'repuestoId'       => $request->repuestosSeleccionados[$i],
                        'repuestoNombre'   => $item->nombre, // Acceder directamente al campo nombre
                        'repuestoCantidad' => $request->cantidadRepuestos[$i]
                    ];
                }
            }

            $jsonTrabajadores = [];
            for ($i=0; $i < count($request->trabajadoresSeleccionados); $i++) {
                $jsonTrabajadores[] = [
                    'trabajadorId'     => $request->trabajadoresSeleccionados[$i],
                    'trabajadorNombre' => $request->trabajadores[$i]
                ];
            }

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
            $solicitud->descripcionFalla = $validatedData['descripcionFalla'] ?? '';
            $solicitud->tipoMantenimientos_id = $validatedData['tipoMantenimientos_id'];
            $solicitud->tiempoEstimado = $validatedData['tiempoEstimado'];
            $solicitud->fechaInicio = $validatedData['fechaInicio'];
            $solicitud->fechaTermina = $validatedData['fechaTermina'];
            $solicitud->mantenimientoEficiente = $validatedData['mantenimientoEficiente'];
            $solicitud->totalHorasTrabajadas = $validatedData['totalHorasTrabajadas'];
            $solicitud->tiempoParada = $validatedData['tiempoParada'];
            $solicitud->repuestosUtilizados = json_encode($jsonRepuestos);
            $solicitud->trabajadoresAsignados = json_encode($jsonTrabajadores);
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
        $estados = Estado::where('tipo', 'solicitud')->get();
        $areas = Area::all();
        $trabajadores = Trabajador::all();
        $solicitudHasTrabajador = SolicitudHasTrabajador::where('solicitudes_id', $id)->first();
    
        // $repuestos = Item::where('idItem', $solicitude->repuestosUtilizados)->first();

        // Verificar si el campo repuestosUtilizados tiene contenido
        $repuestosUtilizados = "";
        if (!empty($solicitude->repuestosUtilizados)) {
            // Decodificar el JSON de repuestosUtilizados
            $repuestos = json_decode($solicitude->repuestosUtilizados, true);
    
            // Verificar si la decodificación es exitosa y si es un array
            if (json_last_error() === JSON_ERROR_NONE && is_array($repuestos)) {
                foreach ($repuestos as $value) {
                    // Validar que los campos 'repuestoNombre' existan en el array
                    if (isset($value['repuestoNombre'])) {
                        $repuestosUtilizados .= $value['repuestoNombre'] . " (" . $value['repuestoCantidad'] . "), ";
                    } else {
                        $repuestosUtilizados .= 'Nombre no disponible ';
                    }
                }
            } else {
                // JSON no válido o error de decodificación
                $repuestosUtilizados = 'Repuestos no disponibles o malformados.';
            }
        } else {
            // El campo está vacío o no contiene datos JSON
            $repuestosUtilizados = 'No se encontraron repuestos.';
        }

        // Eliminar la última coma y espacio si la cadena no está vacía
        if (!empty($repuestosUtilizados)) {
            $repuestosUtilizados = rtrim($repuestosUtilizados, ', ');
        }
    
        // Asignar el valor final al campo repuestosUtilizados
        $solicitude->repuestosUtilizados = $repuestosUtilizados;

        //
        $solicitude->trabajadorId = json_decode($solicitude->trabajadoresAsignados, true)[0]['trabajadorId'];
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
            'trabajadores_id' => 'required',
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

        $trabajor = Trabajador::find($validatedData['trabajadores_id']);
        $trabajadorSeleccionado = [[
            'trabajadorId' => $trabajor->idTrabajador,
            'trabajadorNombre' => $trabajor->nombre,
        ]];
        
        // Actualizar los campos de la solicitud
        $solicitud->fecha = $validatedData['fecha'];
        $solicitud->descripcionFalla = 'N/A'; // O dejar como estaba si es necesario
        $solicitud->tipoMantenimientos_id = $validatedData['tipoMantenimientos_id'];
        $solicitud->tiempoEstimado = $validatedData['tiempoEstimado'];
        $solicitud->fechaInicio = $validatedData['fechaInicio'] ?? null;
        $solicitud->fechaTermina = $validatedData['fechaTermina'];
        $solicitud->mantenimientoEficiente = $validatedData['mantenimientoEficiente'];
        $solicitud->totalHorasTrabajadas = $validatedData['totalHorasTrabajadas'];
        $solicitud->tiempoParada = $validatedData['tiempoParada'];
        // $solicitud->repuestosUtilizados = implode(', ', $validatedData['repuestosSeleccionados']);
        $solicitud->trabajadoresAsignados = json_encode($trabajadorSeleccionado);
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
