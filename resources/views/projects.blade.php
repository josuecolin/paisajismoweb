@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="bg-success bg-gradient text-white py-5 mb-4 shadow-sm">
    <div class="container text-center">
        <h1 class="fw-bold">🌿 Galería de Paisajismo</h1>
        <p class="lead">Explora diseños y creaciones de nuestra comunidad</p>
    </div>
</div>

<div class="container">

    <!-- BOTÓN CREAR -->
    <div class="text-end mb-4">
        <a href="/posts/create" class="btn btn-success rounded-pill px-4 shadow">
            ➕ Nueva publicación
        </a>
    </div>

    <!-- GRID DE PUBLICACIONES -->
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-4 mb-4">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <!-- IMAGEN -->
                    @if($post->imagen)
                        <img src="{{ asset('storage/' . $post->imagen) }}"
                             class="card-img-top rounded-top-4"
                             style="height: 220px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x220?text=Paisajismo"
                             class="card-img-top rounded-top-4">
                    @endif

                    <!-- CONTENIDO -->
                    <div class="card-body">

                        <h5 class="fw-bold text-success">
                            {{ $post->titulo }}
                        </h5>

                        <p class="text-muted">
                            {{ Str::limit($post->contenido, 100) }}
                        </p>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer bg-white border-0">

                        <div class="d-flex justify-content-between align-items-center">

                            <small class="text-muted">
                                👤 {{ $post->user->name }}
                            </small>

                            <small class="text-muted">
                                {{ $post->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>

                </div>

            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-success">
                    🌱 Aún no hay publicaciones. ¡Sé el primero en crear una!
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection