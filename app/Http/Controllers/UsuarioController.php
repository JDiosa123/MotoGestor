<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('Usuario.Registrar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:usuario',
            'password' => 'required|min:5',
            'rol' => 'required'
        ]);

        
        $estado = $request->has('estado') ? 1 : 0;

        Usuario::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => $estado,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Usuario creado correctamente');
    }

    public function editForm()
    {
        return view('Usuario.Editar');
    }
public function update(Request $request)
{
    $request->validate([
        'username' => 'required|exists:usuario,username',
        'password' => 'required|min:5|confirmed',
    ]);

    $usuario = Usuario::where('username', $request->username)->first();

    // Verificar si la nueva contraseña coincide con la actual
    if (Hash::check($request->password, $usuario->password)) {
        return back()->with('error', '⚠️ La nueva contraseña no puede ser igual a la anterior.');
    }

    // Guardar la nueva contraseña
    $usuario->password = Hash::make($request->password);
    $usuario->save();

    return redirect()->route('login')->with('success', '✅ Contraseña actualizada correctamente.');
}
}