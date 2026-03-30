@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="bg-success bg-gradient text-white py-5 mb-4 shadow-sm">
    <div class="container text-center">
        <h1 class="fw-bold">🌱 Crear nueva publicación</h1>
        <p class="lead">Comparte tus ideas de paisajismo y transforma espacios</p>
    </div>
</div>

<!-- FORMULARIO -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">

                    <form action="/posts" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- TÍTULO -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                🌿 Título del proyecto
                            </label>
                            <input 
                                type="text" 
                                name="titulo" 
                                class="form-control form-control-lg rounded-3 shadow-sm"
                                placeholder="Ej. Jardín moderno con suculentas">
                        </div>

                        <!-- CONTENIDO -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                🪴 Descripción
                            </label>
                            <textarea 
                                name="contenido" 
                                rows="4"
                                class="form-control rounded-3 shadow-sm"
                                placeholder="Describe tu diseño, plantas utilizadas, estilo..."></textarea>
                        </div>

                        <!-- IMAGEN -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-success">
                                📸 Imagen del diseño
                            </label>
                            <input 
                                type="file" 
                                name="imagen" 
                                class="form-control rounded-3 shadow-sm">
                        </div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-between">
                            <a href="/posts" class="btn btn-outline-secondary rounded-pill px-4">
                                ← Volver
                            </a>

                            <button class="btn btn-success rounded-pill px-4 shadow">
                                🌱 Publicar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection