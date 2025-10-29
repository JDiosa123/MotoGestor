<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');

Route::get('/usuario/edit', [UsuarioController::class, 'editForm'])->name('usuario.editForm');
Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('Dashboard.admin');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:almacenista'])->get('/almacenista/dashboard', function () {
    return view('Dashboard.almacenista');
})->name('almacenista.dashboard');

Route::middleware(['auth', 'role:mecanico'])->get('/mecanico/dashboard', function () {
    return view('Dashboard.mecanico');
})->name('mecanico.dashboard');
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
