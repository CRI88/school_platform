@extends('layouts.layout')

@section('title', 'Projects List')

@section('content')
<h1>Projects List</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create New Project</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->deadline }}</td>
                <td>{{ $project->user->name }}</td>
                <td>
                    <!-- Botón para ver detalles (todos pueden ver) -->
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>

                    <!-- Botón para editar (solo admin o dueño del proyecto) -->
                    @if (auth()->user()->role === 'admin' || auth()->user()->id === $project->user_id)
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif

                    <!-- Botón para eliminar (solo admin o dueño del proyecto) -->
                    @if (auth()->user()->role === 'admin' || auth()->user()->id === $project->user_id)
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No projects found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
