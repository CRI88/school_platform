<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;

Route::get('/home', function () {
    return view('home');
});

// Ruta de inicio con redirección basada en el rol
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('projects.index'); // Administrador redirige a projects.index
        } elseif (auth()->user()->role === 'student') {
            return redirect()->route('projects.index'); // Estudiante redirige a projects.index
        }
    }
    return redirect('/login'); // Usuarios no autenticados redirigen a welcome
});

// Rutas protegidas con autenticación y rol
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rutas compartidas por ambos roles
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
});

// Rutas protegidas para administradores
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    // Rutas completas del CRUD para administradores
    Route::resource('projects', ProjectController::class)->except(['index']); // index ya está en un grupo compartido
});

// Rutas protegidas para estudiantes
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    // Los estudiantes solo pueden almacenar proyectos
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
});

// Rutas protegidas para el dashboard
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rutas adicionales
Route::view('/home', 'home')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
});