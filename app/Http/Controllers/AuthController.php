<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('Usuario.Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            switch ($user->rol) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'almacenista':
                    return redirect()->route('almacenista.dashboard');
                case 'mecanico':
                    return redirect()->route('mecanico.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Rol no válido.');
            }
        }

        return back()->withErrors(['username' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
