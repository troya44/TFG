<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InscripcionesController;

Route::get('/', function () {
    return redirect()->route('login'); 
});


// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Ruta para procesar el formulario de registro (POST)
Route::post('/register', [AuthController::class, 'register']);



Route::get('/usuarios/crear', [AuthController::class, 'create'])->name('auth.crear');
Route::post('/usuarios', [AuthController::class, 'store'])->name('auth.store');

Route::get('/inicio', [AuthController::class, 'index'])->name('inicio');

Route::get('/pruebas', [CarreraController::class, 'index'])->name('pruebas');   
