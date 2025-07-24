<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UfController;
use App\Http\Controllers\Api\ProjectApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas API para proyectos - nuevas
Route::get('/projects', [ProjectApiController::class, 'index']);           // Listar todos
Route::post('/projects', [ProjectApiController::class, 'store']);          // Agregar proyecto
Route::get('/projects/{id}', [ProjectApiController::class, 'show']);       // Obtener por ID
Route::put('/projects/{id}', [ProjectApiController::class, 'update']);     // Actualizar por ID
Route::delete('/projects/{id}', [ProjectApiController::class, 'destroy']); // Eliminar por ID

// Se crea ruta que apunta al controlador ProyectoController e irá al método getProyectos
// que se encargará de listar los proyectos
Route::get('/proyectos',[ProyectoController::class, 'getProyectos']);

// Se crea ruta que apunta al controlador ProyectoController e irá al método getProyecto
//que se encargará de obtener un proyecto específico por su ID
Route::get('/proyecto/{id}', [ProyectoController::class, 'getProyecto']);

// Se crea ruta que apunta al controlador ProyectoController e irá al método postProyecto
// que se encargará de crear un nuevo proyecto
Route::post('/proyecto', [ProyectoController::class, 'postProyecto']);

// Se crea ruta que apunta al controlador ProyectoController e irá al método deleteProyecto
// que se encargará de eliminar un proyecto por su ID
Route::delete('/proyecto/{id}', [ProyectoController::class, 'deleteProyecto']);

// Se crea ruta que apunta al controlador ProyectoController e irá al método putProyecto
// que se encargará de actualizar un proyecto por su ID
Route::put('/proyecto/{id}', [ProyectoController::class, 'putProyecto']);

Route::get('/uf',[UfController::class, 'getUf']);
Route::get('/uf-value',[UfController::class, 'getCurrentValue']);

