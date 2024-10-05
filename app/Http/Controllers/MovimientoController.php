<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\Item;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\MovimientosExport;
use Maatwebsite\Excel\Facades\Excel;

class MovimientoController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');
        $tipoMovimiento = $request->query('tipoMovimientos_id');
        $itemName = $request->query('item_name');
        
        $movimientos = Movimiento::when($search, function ($query, $search) {
                return $query->where('observacion', 'like', '%' . $search . '%')
                    ->orWhere('numRemisionProveedor', 'like', '%' . $search . '%')
                    ->orWhere('firma', 'like', '%' . $search . '%')
                    ->orWhere('proveedor', 'like', '%' . $search . '%');
            })
            ->when($tipoMovimiento, function ($query, $tipoMovimiento) {
                return $query->where('tipoMovimientos_id', $tipoMovimiento);
            })
            ->when($itemName, function ($query, $itemName) {
                return $query->whereHas('item', function ($query) use ($itemName) {
                    $query->where('nombre', 'like', '%' . $itemName . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Cambia 10 por el número de elementos que quieras por página
            
        // Obtener todos los tipos de movimientos para el filtro
        $tiposMovimientos = TipoMovimiento::all();
    
        return view('movimientos.index', compact('movimientos', 'tiposMovimientos'));
    }
    
    
    public function show($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        return view('movimientos.show', compact('movimiento'));
    }
    
    

    public function create()
    {
        $usuarios = Usuario::all();
        $items = Item::all();
        $tiposMovimientos = TipoMovimiento::all();
        $solicitudes = Solicitud::all();

        return view('movimientos.create', compact('usuarios', 'items', 'tiposMovimientos', 'solicitudes'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $items = Item::where('nombre', 'LIKE', "%{$query}%")->get();

        $results = $items->map(function ($item) {
            return [
                'id' => $item->idItem,
                'name' => $item->nombre,
            ];
        });

        return response()->json($results);
    }

    public function store(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $validatedData = $request->validate([
                'fecha' => 'required|date',
                'tipoMovimientos_id' => 'required|integer',
                'cantidad' => 'required|integer',
                'precio' => 'nullable|numeric',
                'total' => 'required|numeric',
                'items_id' => 'required|integer',
                'usuarios_id' => 'required|integer',
                'numRemisionProveedor' => 'nullable|string|max:45',
                'colaborador' => 'nullable|string|max:255',
                'proveedor' => 'nullable|string|max:255',
                'observacion' => 'nullable|string',
                'solicitudes_id' => 'nullable|integer',
            ]);

            // Crear el movimiento
            $movimiento = Movimiento::create($validatedData);

            // Obtener el ítem asociado
            $item = Item::findOrFail($validatedData['items_id']);
            
            // Ajustar la cantidad del ítem según el tipo de movimiento
            $tipoMovimiento = TipoMovimiento::findOrFail($validatedData['tipoMovimientos_id']);

            if ($tipoMovimiento->Operacion == 1) { // valida el tipo de operacion 1 = suma
                // Sumar la cantidad al ítem
                $item->cantidad += $validatedData['cantidad'];
            } elseif ($tipoMovimiento->Operacion == 0) { // valida el tipo de operacion 0 = resta 
                // Restar la cantidad del ítem
                $item->cantidad -= $validatedData['cantidad'];
            }

            // Guardar los cambios en el ítem
            $item->save();

            return redirect()->route('movimientos.index')->with('success', 'Movimiento creado con éxito.');
        } catch (\Exception $e) {
            // Manejar el error y redirigir
            return redirect()->back()->with('error', 'Ocurrió un error al crear el movimiento. Por favor, inténtalo de nuevo.');
        }
    }

    

    public function edit($id)
    {
        $movimiento = Movimiento::with('item', 'solicitud')->findOrFail($id);
        $usuarios = Usuario::all();
        $solicitudes = Solicitud::all();
        $items = Item::all();
        $tiposMovimientos = TipoMovimiento::all();
    
        return view('movimientos.edit', compact('movimiento', 'usuarios', 'solicitudes', 'items', 'tiposMovimientos'));
    }
    

    public function update(Request $request, $id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'total' => 'required|numeric',
            'proveedor' => 'required|string|max:255',
            'numRemisionProveedor' => 'nullable|string|max:45',
            'firma' => 'required|string|max:255',
            'colaborador' => 'required|string|max:255',
            'tipoMovimientos_id' => 'required|integer',
            'observacion' => 'nullable|string',
        ]);

        $movimiento->update($validatedData);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento actualizado con éxito.');
    }

    public function destroy($idMovimiento)
    {
        $movimiento = Movimiento::findOrFail($idMovimiento);

        // Obtener el ítem asociado
        $item = Item::findOrFail($movimiento->items_id);
            
        // Ajustar la cantidad del ítem según el tipo de movimiento
        $tipoMovimiento = TipoMovimiento::findOrFail($movimiento->tipoMovimientos_id);

        if ($tipoMovimiento->Operacion == 1) { // valida el tipo de operacion 1 = suma
            // Sumar la cantidad al ítem
            $item->cantidad -= $movimiento->cantidad;
        } elseif ($tipoMovimiento->Operacion == 0) { // valida el tipo de operacion 0 = resta 
            // Restar la cantidad del ítem
            $item->cantidad += $movimiento->cantidad;
        }

        // Guardar los cambios en el ítem
        $item->save();
        // elimina el movimiento
        $movimiento->delete();

        return redirect()->route('movimientos.index');
    }
}
