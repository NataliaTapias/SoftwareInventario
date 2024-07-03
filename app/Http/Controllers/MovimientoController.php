<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\Item;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $movimientos = Movimiento::when($search, function ($query, $search) {
            return $query->where('firma', 'like', '%' . $search . '%')
                ->orWhere('proveedor', 'like', '%' . $search . '%');
        })->get();

        return view('movimientos.index', compact('movimientos'));
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
        // Validación y almacenamiento de los datos
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'total' => 'required|numeric',
            'numRemisionProveedor' => 'nullable|string|max:45',
            'firma' => 'required|string|max:255',
            'proveedor' => 'required|string|max:255',
            'colaborador' => 'required|string|max:255',
            'tipoMovimientos_id' => 'required|integer',
            'observacion' => 'nullable|string',
            'usuarios_id' => 'required|integer', // Asegúrate de validar que el usuario está logeado o que se envía el ID correcto
            'solicitudes_id' => 'required|integer',
            'items_id' => 'required|integer',
        ]);
    
        // Asignar los IDs desde el formulario
        $movimientoData = [
            'fecha' => $validatedData['fecha'],
            'cantidad' => $validatedData['cantidad'],
            'precio' => $validatedData['precio'],
            'total' => $validatedData['total'],
            'numRemisionProveedor' => $validatedData['numRemisionProveedor'],
            'firma' => $validatedData['firma'],
            'colaborador' => $validatedData['colaborador'],
            'proveedor' => $validatedData['proveedor'],
            'tipoMovimientos_id' => $validatedData['tipoMovimientos_id'],
            'observacion' => $validatedData['observacion'],
            'usuarios_id' => $validatedData['usuarios_id'],
            'solicitudes_id' => $validatedData['solicitudes_id'],
            'items_id' => $validatedData['items_id'],
        ];
    
        // Crear el movimiento con los datos validados
        Movimiento::create($movimientoData);
    
        return redirect()->route('movimientos.index')->with('success', 'Movimiento creado con éxito.');
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
        $movimiento->delete();

        return redirect()->route('movimientos.index');
    }
}
