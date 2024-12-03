@extends('layouts.layout')

@section('title', 'Inicio - Plataforma Escolar')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="bg-light py-5">
    <div class="container text-center">
        <!-- Encabezado principal -->
        <h1 class="display-4 text-primary fw-bold mb-4">Bienvenido a la Plataforma Escolar</h1>
        <p class="lead text-muted mb-5">Gestiona proyectos de manera eficiente y organiza tareas en equipo con facilidad.</p>

        <!-- Sección de características -->
        <div class="row g-4">
            <!-- Bloque 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0 hover-card">
                    <img src="{{ asset('images/interrogante.png') }}" class="card-img-top mx-auto mt-3" alt="Gestión de Proyectos" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">¿Qué es la Plataforma?</h5>
                        <p class="card-text text-muted">Es una herramienta diseñada para gestionar proyectos asignados a los usuarios de manera sencilla.</p>
                    </div>
                </div>
            </div>
            <!-- Bloque 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0 hover-card">
                    <img src="{{ asset('images/lapiz.png') }}" class="card-img-top mx-auto mt-3" alt="Gestión de Proyectos" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">¿Qué se puede hacer?</h5>
                        <p class="card-text text-muted">Crear, ver, editar y eliminar proyectos para mantener un control eficiente sobre las tareas asignadas.</p>
                    </div>
                </div>
            </div>
            <!-- Bloque 3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow border-0 hover-card">
                    <img src="{{ asset('images/emoji.png') }}" class="card-img-top mx-auto mt-3" alt="Colaboración" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">¿Por qué es útil?</h5>
                        <p class="card-text text-muted">Facilita la organización y mejora la colaboración en el ámbito escolar.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de acción -->
        <div class="mt-5">
            <a href="{{ url('/projects') }}" class="btn btn-primary btn-lg px-5 py-3 shadow">
                Explorar Proyectos
            </a>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
</style>

@endsection
