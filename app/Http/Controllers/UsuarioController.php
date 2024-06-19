<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cargo' => 'nullable|string|max:45',
            'email' => 'required|email|unique:Usuarios',
            'password' => 'required|min:8',
            'roles_id' => 'required|exists:Roles,idRol',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->input('password'));

        Usuario::create($data);
        return redirect()->route('usuarios.index');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }
    

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required',
            'cargo' => 'nullable|string|max:45',
            'email' => 'required|email|unique:Usuarios,email,' . $usuario->idUsuario,
            'password' => 'nullable|min:8',
            'roles_id' => 'required|exists:Roles,idRol',
        ]);

        $data = $request->all();
        if($request->filled('password')){
            $data['password'] = bcrypt($request->input('password'));
        } else {
            unset($data['password']);
        }

        $usuario->update($data);
        return redirect()->route('usuarios.index');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}
