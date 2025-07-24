<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller

{
    // Se define una lista de proyectos como ejemplo
    private $listaProyectos = [
        [
            'id' => 1,
            'nombre' => 'Proyecto de Desarrollo Web',
            'fechaInicio' => '2025-01-01',
            'estado' => 'En curso',
            'responsable' => 'María García',
            'monto' => 5000
        ],
        [
            'id' => 2,
            'nombre' => 'Sistema de Gestión de Inventario',
            'fechaInicio' => '2025-03-15',
            'estado' => 'Pendiente',
            'responsable' => 'Juan Pérez',
            'monto' => 12000
        ]
    ];

    // Método para obtener la lista de proyectos desde la lista creada
    // y retornar la vista correspondiente
    public function getProyectos()
    {
        $proyectos = $this->listaProyectos;
        return view('get-proyectos', compact('proyectos'));
    }

    // Método que obtiene un proyecto específico por su ID
    public function getProyecto($id)
    {
        foreach ($this->listaProyectos as $proyecto) {
            if ($proyecto['id'] == $id) {
                return view('get-proyecto', compact('proyecto'));
            }
        }
        return view('error', compact('id'));
    }

    // Método para crear un nuevo proyecto, recibiendo los datos como Request
    public function postProyecto(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->id = $request->input('id');
        $proyecto->nombre = $request->input('nombre');
        $proyecto->fechaInicio = $request->input('fechaInicio');
        $proyecto->estado = $request->input('estado');
        $proyecto->responsable = $request->input('responsable');
        $proyecto->monto = $request->input('monto');
        return view('post-proyecto', compact('proyecto'));
    }

    // Método para eliminar un proyecto por su ID (utizando la lista creada como ejemplo)
    public function deleteProyecto($id)
    {
        foreach ($this->listaProyectos as $index => $proyecto) {
            if ($proyecto['id'] == $id) {
                unset($this->listaProyectos[$index]);
                return view('delete-proyecto', compact('proyecto'));
            }
        }
        return view('error', compact('id'));
    }

    // Método para actualizar un proyecto por su ID (utilkizando la lista creada como ejemplo)
    public function putProyecto(Request $request, $id)
    {

        foreach ($this->listaProyectos as $proyecto) {
            if ($proyecto['id'] == $id) {

                if ($request->has('nombre')) {
                    $proyecto['nombre'] = $request->input('nombre');
                }
                if ($request->has('fechaInicio')) {
                    $proyecto['fechaInicio'] = $request->input('fechaInicio');
                }
                if ($request->has('estado')) {
                    $proyecto['estado'] = $request->input('estado');
                }
                if ($request->has('responsable')) {
                    $proyecto['responsable'] = $request->input('responsable');
                }
                if ($request->has('monto')) {
                    $proyecto['monto'] = $request->input('monto');
                }
                return view('put-proyecto', compact('proyecto'));
            }
        }
        return view('error', compact('id'));
    }
}
