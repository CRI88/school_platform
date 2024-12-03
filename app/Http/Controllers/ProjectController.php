<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Todos los usuarios ven todos los proyectos
        $projects = Project::with('user')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => auth()->id(), // Asociar al usuario autenticado
        ]);

        return redirect()->route('projects.index')->with('success', '¡Proyecto creado exitosamente!');
    }

    public function show(Project $project)
    {
        // Todos los usuarios pueden ver cualquier proyecto
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $user = auth()->user();

        // El administrador puede editar todos los proyectos
        if ($user->role === 'admin' || $project->user_id === $user->id) {
            return view('projects.edit', compact('project'));
        }

        // Si no tiene permiso
        abort(403, 'No tienes permiso para editar este proyecto.');
    }

    public function update(Request $request, Project $project)
    {
        $user = auth()->user();

        // Solo permitir si es admin o el propietario del proyecto
        if ($user->role === 'admin' || $project->user_id === $user->id) {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'deadline' => 'required|date',
            ]);

            $project->update($request->only(['name', 'description', 'deadline']));

            return redirect()->route('projects.index')->with('success', '¡Proyecto actualizado exitosamente!');
        }

        // Si no tiene permiso
        abort(403, 'No tienes permiso para actualizar este proyecto.');
    }

    public function destroy(Project $project)
    {
        $user = auth()->user();

        // Solo permitir si es admin o el propietario del proyecto
        if ($user->role === 'admin' || $project->user_id === $user->id) {
            $project->delete();
            return redirect()->route('projects.index')->with('success', '¡Proyecto eliminado exitosamente!');
        }

        // Si no tiene permiso
        abort(403, 'No tienes permiso para eliminar este proyecto.');
    }
}
