<?php

use App\Http\Controllers\PrisioneroController;

use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitanteController;

use App\Models\Visita;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/prisioneros', PrisioneroController::class)->middleware('auth');
Route::resource('/guardias', GuardiaController::class)->middleware('auth');
Route::resource('/visitas', VisitaController::class)->middleware('auth');
Route::resource('/visitantes', VisitanteController::class)->middleware('auth');


