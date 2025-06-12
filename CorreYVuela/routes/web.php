<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InscripcionesController;
use App\Http\Controllers\GaleriaController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

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


Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::get('/galeria/create', [GaleriaController::class, 'create'])->name('galeria.create');
Route::post('/galeria', [GaleriaController::class, 'store'])->name('galeria.store');

Route::get('/menuUsuario', [AuthController::class, 'menuUsuario'])->name('menuUsuario');
Route::post('/menuUsuario/actualizar', [AuthController::class, 'actualizarPerfil'])->name('auth.actualizarPerfil');
Route::post('/menuUsuario/foto', [AuthController::class, 'actualizarFoto'])->name('auth.actualizarFoto');


Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
