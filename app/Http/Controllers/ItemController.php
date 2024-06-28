<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Subcategoria;
use App\Models\Estado;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request){
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
    
    // Obtenemos los ítems con los filtros aplicados
    $items = $query->get();
    
    // Obtener todas las categorías para el filtro
    $categorias = \App\Models\Subcategoria::all();
    
    return view('items.index', compact('items', 'categorias'));

    // busqueda de items en movimiento 
    
   }

   public function search(Request $request)
   {
       $query = $request->get('query', '');
       $items = Item::where('nombre', 'LIKE', "%{$query}%")->get();
       return response()->json($items);
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


