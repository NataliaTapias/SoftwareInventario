<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function mostrarVista()
    {
        $titulo = 'Bienvenido al panel Admin de Quimint';
        $contenido = 'Este es el panel principal';

        // Obtener todos los ítems de la base de datos
        $items = Item::all();

        return view('home', [
            'titulo' => $titulo,
            'contenido' => $contenido,
            'items' => $items,
        ]);
    }
}
