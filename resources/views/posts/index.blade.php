@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap');

    :root {
        --verde-bosque: #2D5016;
        --verde-medio: #4A7C2F;
        --verde-claro: #7AAD52;
        --crema: #F5F0E8;
        --tierra: #8B6914;
        --cafe: #3D2B1F;
        --blanco-roto: #FDFAF5;
    }

    body { background-color: var(--crema); font-family: 'Lato', sans-serif; }

    .hero-banner {
        background: linear-gradient(135deg, var(--verde-bosque) 0%, var(--verde-medio) 60%, var(--verde-claro) 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 10%;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }
    .hero-sub {
        font-family: 'Lato', sans-serif;
        font-weight: 300;
        color: rgba(255,255,255,0.85);
        font-size: 1.1rem;
        letter-spacing: 0.05em;
    }
    .btn-nueva-pub {
        background: #fff;
        color: var(--verde-bosque);
        font-weight: 700;
        font-family: 'Lato', sans-serif;
        letter-spacing: 0.04em;
        padding: 0.65rem 1.8rem;
        border-radius: 50px;
        border: none;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .btn-nueva-pub:hover {
        background: var(--verde-bosque);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    .section-label {
        font-family: 'Lato', sans-serif;
        font-size: 0.75rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--verde-medio);
        font-weight: 700;
        margin-bottom: 0.3rem;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem;
        color: var(--cafe);
        font-weight: 600;
    }
    .card-post {
        background: var(--blanco-roto);
        border: 1px solid rgba(74,124,47,0.12);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
    }
    .card-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(45,80,22,0.13);
    }
    .card-post img {
        width: 100%;
        height: 210px;
        object-fit: cover;
    }
    .card-post .img-placeholder {
        width: 100%;
        height: 210px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }
    .card-body-custom { padding: 1.4rem 1.5rem; }
    .post-titulo {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--cafe);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .post-contenido {
        font-size: 0.9rem;
        color: #6b7a6b;
        line-height: 1.6;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .post-fecha {
        font-size: 0.75rem;
        letter-spacing: 0.08em;
        color: var(--verde-medio);
        text-transform: uppercase;
        font-weight: 700;
    }
    .btn-accion {
        border: none;
        border-radius: 8px;
        padding: 0.4rem 0.9rem;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-ver { background: #e8f5e9; color: var(--verde-bosque); }
    .btn-ver:hover { background: var(--verde-bosque); color: #fff; }
    .btn-editar { background: #fff8e1; color: var(--tierra); }
    .btn-editar:hover { background: var(--tierra); color: #fff; }
    .btn-eliminar { background: #fde8e8; color: #b91c1c; }
    .btn-eliminar:hover { background: #b91c1c; color: #fff; }
    .empty-state {
        background: var(--blanco-roto);
        border: 2px dashed rgba(74,124,47,0.25);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
    }
    .empty-icon { font-size: 4rem; margin-bottom: 1rem; }
    .empty-text {
        font-family: 'Playfair Display', serif;
        color: var(--cafe);
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
    }
    .empty-sub { color: #8a9e8a; font-size: 0.95rem; }
    .divider-leaf {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 2rem 0;
    }
    .divider-leaf::before, .divider-leaf::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(74,124,47,0.2);
    }
    .divider-leaf span { color: var(--verde-claro); font-size: 1.1rem; }
</style>

<!-- HERO -->
<div class="hero-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="section-label mb-1" style="color:rgba(255,255,255,0.7);">Paisajismo & Diseño</p>
                <h1 class="hero-title">Publicaciones</h1>
                <p class="hero-sub">Inspírate con proyectos de jardines, terrazas y espacios verdes</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('posts.create') }}" class="btn-nueva-pub">
                    ✦ Nueva publicación
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CONTENIDO -->
<div class="container py-5">

    @if(session('success'))
        <div class="alert d-flex align-items-center gap-2 mb-4" 
             style="background:#e8f5e9;border:1px solid rgba(74,124,47,0.3);border-radius:12px;color:var(--verde-bosque);font-weight:600;">
            <span>🌿</span> {{ session('success') }}
        </div>
    @endif

    @if($posts->count() > 0)

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <p class="section-label">Proyectos compartidos</p>
                <h2 class="section-title">Todos los proyectos</h2>
            </div>
            <span style="color:#8a9e8a;font-size:0.9rem;">{{ $posts->count() }} publicación(es)</span>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card-post">

                    @if($post->imagen)
                        <img src="{{ asset('storage/' . $post->imagen) }}" alt="{{ $post->titulo }}">
                    @else
                        <div class="img-placeholder">🌿</div>
                    @endif

                    <div class="card-body-custom">
                        <p class="post-fecha">{{ $post->created_at->format('d M Y') }}</p>
                        <h3 class="post-titulo">{{ $post->titulo }}</h3>
                        <p class="post-contenido">{{ $post->contenido }}</p>

                        <div class="divider-leaf"><span>❧</span></div>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('posts.show', $post) }}" class="btn-accion btn-ver">
                                Ver →
                            </a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn-accion btn-editar">
                                Editar
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" 
                                  onsubmit="return confirm('¿Eliminar esta publicación?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-accion btn-eliminar">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>

    @else
        <div class="empty-state">
            <div class="empty-icon">🌱</div>
            <h3 class="empty-text">Aún no hay publicaciones</h3>
            <p class="empty-sub">¡Sé el primero en compartir tu proyecto de paisajismo!</p>
            <a href="{{ route('posts.create') }}" class="btn-nueva-pub mt-3 d-inline-block" 
               style="background:var(--verde-bosque);color:#fff;">
                + Crear primera publicación
            </a>
        </div>
    @endif

</div>

@endsection