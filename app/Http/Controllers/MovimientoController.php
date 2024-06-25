<?php
namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\Item;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $movimientos = Movimiento::when($search, function ($query, $search) {
            return $query->where('firma', 'like', '%'.$search.'%')
                         ->orWhere('proveedor', 'like', '%'.$search.'%');
        })->get();

        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $items = Item::all();
        $tiposMovimientos = TipoMovimiento::all();
        $solicitudes = Solicitud::all();
    
        return view('movimientos.create', compact('usuarios', 'items', 'tiposMovimientos','solicitudes'));
    }
    

    public function store(Request $request)
{
    $movimiento = new Movimiento();
    $movimiento->fecha = $request->input('fecha');
    $movimiento->cantidad = $request->input('cantidad');
    $movimiento->precio = $request->input('precio');
    $movimiento->numRemisionProveedor = $request->input('numRemisionProveedor');
    $movimiento->observacion = $request->input('observacion');
    $movimiento->firma = $request->input('firma');
    $movimiento->proveedor = $request->input('proveedor');
    $movimiento->colaborador = $request->input('colaborador');
    $movimiento->usuarios_id = $request->input('usuarios_id');
    $movimiento->solicitudes_id = $request->input('solicitudes_id');
    $movimiento->items_id = $request->input('items_id');
    $movimiento->tipoMovimientos_id = $request->input('tipoMovimientos_id');
    $movimiento->save();

    return redirect()->route('movimientos.index');
}


public function edit($id)
{
    $movimiento = Movimiento::findOrFail($id);
    $usuarios = Usuario::all();
    $solicitudes = Solicitud::all();
    $items = Item::all();
    $tipoMovimientos = TipoMovimiento::all();

    return view('movimientos.edit', compact('movimiento', 'usuarios', 'solicitudes', 'items', 'tipoMovimientos'));
}

    public function update(Request $request, $idMovimiento)
    {
        $movimiento = Movimiento::findOrFail($idMovimiento);
        $movimiento->fecha = $request->input('fecha');
        $movimiento->cantidad = $request->input('cantidad');
        $movimiento->precio = $request->input('precio');
        $movimiento->numRemisionProveedor = $request->input('numRemisionProveedor');
        $movimiento->observacion = $request->input('observacion');
        $movimiento->firma = $request->input('firma');
        $movimiento->proveedor = $request->input('proveedor');
        $movimiento->colaborador = $request->input('colaborador');
        $movimiento->usuarios_id = $request->input('usuarios_id');
        $movimiento->solicitudes_id = $request->input('solicitudes_id');
        $movimiento->items_id = $request->input('items_id');
        $movimiento->tipoMovimientos_id = $request->input('tipoMovimientos_id');
        $movimiento->save();

        return redirect()->route('movimientos.index');
    }

    public function destroy($idMovimiento)
    {
        $movimiento = Movimiento::findOrFail($idMovimiento);
        $movimiento->delete();

        return redirect()->route('movimientos.index');
    }
}
