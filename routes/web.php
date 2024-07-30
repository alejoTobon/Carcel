<?php

use App\Http\Controllers\PrisioneroController;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirigir la ruta raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticación
Auth::routes();

// Ruta para la página de inicio, protegida por el middleware auth
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
// Rutas de recursos protegidas por el middleware auth
Route::resource('/prisioneros', PrisioneroController::class)->middleware('auth');
Route::resource('/guardias', GuardiaController::class)->middleware('auth');
Route::resource('/visitas', VisitaController::class)->middleware('auth');
Route::resource('/visitantes', VisitanteController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
