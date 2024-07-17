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
    public function show(Request $request, $id)
    {
        // Check if it's an AJAX request for item search
        if ($request->ajax()) {
            $query = $request->input('query');
            $itemsQuery = Item::where('nombre', 'LIKE', "%{$query}%");
    
            // Verificar el rol del usuario
            if (Auth::user()->hasRole('logistica')) {
                $subcategoria = $request->input('subcategoria', 'logistica'); // Default to 'logistica' if not provided
                $itemsQuery->whereHas('subcategoria', function ($q) use ($subcategoria) {
                    $q->where('nombre', $subcategoria);
                });
            }
    
            $items = $itemsQuery->get();
    
            return response()->json($items);
        }
    
        // Normal show method logic if it's not an AJAX request
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }
    



    public function create()
    {
        $subcategorias = Subcategoria::all();
        $estados = Estado::all();
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

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Ítem creado con éxito');
    }

    public function edit(Item $item)
    {
        $subcategorias = Subcategoria::all();
        $estados = Estado::all();
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

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Ítem actualizado con éxito');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Ítem eliminado con éxito');
    }
}


