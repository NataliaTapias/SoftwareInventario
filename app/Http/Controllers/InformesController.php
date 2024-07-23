<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformesController extends Controller
{
    public function index(Request $request)
    {
        return view('informes.index');
    }
    
}
