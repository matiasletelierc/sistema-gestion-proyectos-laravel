<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

// Rutas para proyectos (web views)
Route::resource('projects', ProjectController::class);

// Ruta para UF (página web)
Route::get('/uf', [UfController::class, 'showUfPage']);

// Ruta para UF (API)
Route::get('/api/uf-value', [UfController::class, 'getCurrentValue']);

