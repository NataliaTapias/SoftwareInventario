<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Subcategoria;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ItemController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');
        $subcategoriaNombre = $request->input('subcategoria');



        $items = Item::where('nombre', 'LIKE', "%$query%");

        if ($subcategoriaNombre) {
            $items->whereHas('subcategoria', function ($q) use ($subcategoriaNombre) {
                $q->where('nombre', $subcategoriaNombre);
            });
        }

        $items = $items->get();

        return response()->json($items);

        if (!$query) {
            return response()->json(['error' => 'No query provided'], 400);
        }

        $items = Item::where('nombre', 'LIKE', "%{$query}%")->get(['idItem as id', 'nombre as name']);

        return response()->json($items);
    }
    
 
    public function index(Request $request)
    {
        // Capturamos los parámetros de búsqueda y filtrado
        $search = $request->input('search');
        $categoria = $request->input('categoria');
    
        // Construimos la consulta inicial
        $query = Item::query();
    
        // Aplicamos filtros si existen
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('referencia', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }
    
        if ($categoria) {
            $query->where('subcategorias_id', $categoria);
        }
    
        // Ordenar por fecha de creación y paginar
        $items = $query->orderBy('created_at', 'desc')->paginate(10);
    
        // Obtener todas las categorías para el filtro
        $categorias = \App\Models\Subcategoria::all();
    
        return view('items.index', compact('items', 'categorias'));
    }



 

    // Dentro del ItemController
    public function show(Request $request)
    {
        if ($request->has('query')) {
            $query = $request->input('query');
            $items = Item::where('nombre', 'LIKE', "%{$query}%")->get();
            return response()->json($items);
        }
        return response()->json([]);
    }
    



    public function create()
    {
        $subcategorias = Subcategoria::all();
        $estados = Estado::where('tipo', 'item')->get();
        return view('items.create', compact('subcategorias', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required|string|max:45',
            'nombre' => 'required|string|max:45',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'cantidadMinima' => 'required|integer',
            'unidadMedida' => 'required|string|max:45',
            'subcategorias_id' => 'required|exists:subcategorias,idSubcategoria',
            'estados_id' => 'required|exists:estados,idEstado',
        ]);
    
        // Crear el ítem
        $item = Item::create($request->all());
    
        // Actualizar el estado del ítem según la cantidad
        $this->updateItemStatus($item);
    
        return redirect()->route('items.index')->with('success', 'Ítem creado con éxito');
    }
    

    public function edit(Item $item)
    {
        $subcategorias = Subcategoria::all();
        $estados = Estado::where('tipo', 'item')->get();
        return view('items.edit', compact('item', 'subcategorias', 'estados'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'referencia' => 'required|string|max:45',
            'nombre' => 'required|string|max:45',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'cantidadMinima' => 'required|integer',
            'unidadMedida' => 'required|string|max:45',
            'subcategorias_id' => 'required|exists:subcategorias,idSubcategoria',
            'estados_id' => 'required|exists:estados,idEstado',
        ]);
    
        // Actualizar el ítem
        $item->update($request->all());
    
        // Actualizar el estado del ítem según la cantidad
        $this->updateItemStatus($item);
    
        return redirect()->route('items.index')->with('success', 'Ítem actualizado con éxito');


        if ($item->cantidad <= 0) {
            $estado = Estado::where('nombre', 'Agotado')->first();
        } elseif ($item->cantidad <= $item->cantidadMinima) {
            $estado = Estado::where('nombre', 'Mínimo')->first();
        } else {
            $estado = Estado::where('nombre', 'Disponible')->first();
        }
    
        if ($estado) {
            $item->estados_id = $estado->idEstado;
            $item->save();
        }
    }
    

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Ítem eliminado con éxito');
    }

    private function updateItemStatus(Item $item)
{
    if ($item->cantidad <= 0) {
        $estado = Estado::where('nombre', 'Agotado')->first();
    } elseif ($item->cantidad <= $item->cantidadMinima) {
        $estado = Estado::where('nombre', 'Mínimo')->first();
    } else {
        $estado = Estado::where('nombre', 'Disponible')->first();
    }

    if ($estado) {
        $item->estados_id = $estado->idEstado;
        $item->save();
    }
}
}


