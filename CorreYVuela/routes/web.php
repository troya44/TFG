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


Route::get('/registrarCarrera', [CarreraController::class, 'create'])->name('registrarCarrera');
Route::post('/guardar-carrera', [CarreraController::class, 'guardar'])->name('guardarCarrera');


Route::get('/prueba/{id}/informacion', [CarreraController::class, 'informacionPrueba'])->name('informacionPrueba');
Route::get('/prueba/{id}/inscritos', [CarreraController::class, 'listadoInscritos'])->name('listadoInscritos');
Route::post('/prueba/{id}/inscribirse', [CarreraController::class, 'inscribirse'])->name('inscribirse');




Route::get('/carreras/{carrera}/inscripcion/{usuario}/edit', [CarreraController::class, 'edit'])->name('inscripcion.edit');
Route::put('/carreras/{carrera}/inscripcion/{usuario}', [CarreraController::class, 'update'])->name('inscripcion.update');
Route::delete('/carreras/{carrera}/inscripcion/{usuario}', [CarreraController::class, 'destroy'])->name('inscripcion.destroy');

