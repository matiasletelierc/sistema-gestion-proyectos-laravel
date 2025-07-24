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
            ->with('success', 'Proyecto creado exitosamente.');
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
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    // 4. Controlador para eliminar un proyecto por id
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
