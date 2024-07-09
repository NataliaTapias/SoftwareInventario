<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Role;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));

        $user = User::find(1); // Obtener el usuario deseado, por ejemplo, con id 1
    
        if ($user->hasRole('logistica')) {
            // Acciones específicas para usuarios con el rol 'logistica'
            return "Usuario tiene el rol de logística";
        } elseif ($user->hasRole('consultor')) {
            // Acciones específicas para usuarios con el rol 'consultor'
            return "Usuario tiene el rol de consultor";
        } else {
            // Acciones por defecto para otros roles o sin roles asignados
            return "Usuario no tiene un rol específico";
        }


    }

    public function create()
    {
        $roles = Role::all();
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
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }
    

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:45',
            'email' => 'required|string|email|max:255|unique:Usuarios,email,' . $usuario->idUsuario . ',idUsuario',
            'password' => 'nullable|string|min:8',
            'roles_id' => 'required|exists:Roles,idRol',
        ]);
    
        $data = $request->all();
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
    
        $usuario->update($data);
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
    
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}
