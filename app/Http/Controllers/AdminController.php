<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return view('Dashboard.Admin', compact('usuarios'));
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:usuario,username',
            'password' => 'required|min:5',
            'rol' => 'required',
            'estado' => 'required|boolean',
        ]);

        Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => $request->estado,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuario creado correctamente.');
    }

    // Actualizar usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'rol' => 'required',
            'estado' => 'required|boolean',
        ]);

        $usuario->username = $request->username;
        $usuario->rol = $request->rol;
        $usuario->estado = $request->estado;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Usuario eliminado correctamente.');
    }
}
