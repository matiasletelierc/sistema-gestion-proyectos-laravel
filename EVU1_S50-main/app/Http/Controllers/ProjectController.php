<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // 1. Controlador para obtener los proyectos
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // 2. Controlador para crear un proyecto (mostrar formulario)
    public function create()
    {
        $statusOptions = Project::getStatusOptions();
        return view('projects.create', compact('statusOptions'));
    }

    // 2. Controlador para crear un proyecto (procesar formulario)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|in:planning,in_progress,completed,cancelled',
            'responsible' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0'
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('notification', [
                'type' => 'success',
                'title' => '¡Proyecto Creado!',
                'message' => "El proyecto '{$request->name}' ha sido creado exitosamente.",
                'sound' => true
            ]);
    }

    // 5. Controlador para obtener un proyecto por id
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // 3. Controlador para actualizar un proyecto por id (mostrar formulario)
    public function edit(Project $project)
    {
        $statusOptions = Project::getStatusOptions();
        return view('projects.edit', compact('project', 'statusOptions'));
    }

    // 3. Controlador para actualizar un proyecto por id (procesar formulario)
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'status' => 'required|in:planning,in_progress,completed,cancelled',
            'responsible' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0'
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('notification', [
                'type' => 'success',
                'title' => 'Proyecto Actualizado',
                'message' => "El proyecto '{$project->name}' ha sido actualizado exitosamente.",
                'sound' => true
            ]);
    }

    // 4. Controlador para eliminar un proyecto por id
    public function destroy(Project $project)
    {
        $projectName = $project->name;
        $project->delete();

        return redirect()->route('projects.index')
            ->with('notification', [
                'type' => 'success',
                'title' => 'Proyecto Eliminado',
                'message' => "El proyecto '{$projectName}' ha sido eliminado exitosamente.",
                'sound' => true
            ]);
    }
}
