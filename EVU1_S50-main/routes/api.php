<?php

use App\Http\Controllers\UfController;
use App\Http\Controllers\Api\ProjectApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas API para proyectos
Route::get('/projects', [ProjectApiController::class, 'index']);           // Listar todos
Route::post('/projects', [ProjectApiController::class, 'store']);          // Agregar proyecto
Route::get('/projects/{id}', [ProjectApiController::class, 'show']);       // Obtener por ID
Route::put('/projects/{id}', [ProjectApiController::class, 'update']);     // Actualizar por ID
Route::delete('/projects/{id}', [ProjectApiController::class, 'destroy']); // Eliminar por ID

// Ruta API para UF
Route::get('/uf', [UfController::class, 'getUf']);
Route::get('/uf-value', [UfController::class, 'getCurrentValue']);

