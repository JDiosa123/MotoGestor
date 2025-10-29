<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;

// -------------------------------
// 🔐 AUTENTICACIÓN
// -------------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------------------
// 🧾 REGISTRO Y RECUPERACIÓN DE USUARIOS (público o sin sesión)
// -------------------------------
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store.public');

Route::get('/usuario/edit', [UsuarioController::class, 'editForm'])->name('usuario.editForm');
Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update.public');

// -------------------------------
// 🧑‍💼 DASHBOARD ADMINISTRADOR
// -------------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD de usuarios (solo admin)
    Route::post('/admin/usuarios', [AdminController::class, 'store'])->name('admin.usuario.store');
    Route::put('/admin/usuarios/{id}', [AdminController::class, 'update'])->name('admin.usuario.update');
    Route::delete('/admin/usuarios/{id}', [AdminController::class, 'destroy'])->name('admin.usuario.delete');
});

// -------------------------------
// 🏍️ DASHBOARD ALMACENISTA
// -------------------------------
Route::middleware(['auth', 'role:almacenista'])->get('/almacenista/dashboard', function () {
    return view('Dashboard.almacenista');
})->name('almacenista.dashboard');

// -------------------------------
// 🔧 DASHBOARD MECÁNICO
// -------------------------------
Route::middleware(['auth', 'role:mecanico'])->get('/mecanico/dashboard', function () {
    return view('Dashboard.mecanico');
})->name('mecanico.dashboard');
