<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProjectApiController extends Controller
{
    // 1. Listar todos los proyectos
    public function index(): JsonResponse
    {
        $projects = Project::all();
        
        return response()->json([
            'success' => true,
            'data' => $projects,
            'message' => 'Proyectos obtenidos exitosamente'
        ]);
    }

    // 2. Agregar Proyecto
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|in:planning,in_progress,completed,cancelled',
            'responsible' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0'
        ]);

        $project = Project::create($validated);

        return response()->json([
            'success' => true,
            'data' => $project,
            'message' => 'Proyecto creado exitosamente'
        ], 201);
    }

    // 3. Obtener un proyecto por su id
    public function show($id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $project,
            'message' => 'Proyecto obtenido exitosamente'
        ]);
    }

    // 4. Actualizar proyecto por su id
    public function update(Request $request, $id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'start_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:planning,in_progress,completed,cancelled',
            'responsible' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric|min:0'
        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'data' => $project,
            'message' => 'Proyecto actualizado exitosamente'
        ]);
    }

    // 5. Eliminar proyecto por su Id
    public function destroy($id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proyecto eliminado exitosamente'
        ]);
    }
}
