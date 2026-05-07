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
        background: linear-gradient(135deg, #1a3a2a 0%, var(--verde-bosque) 50%, var(--verde-medio) 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 350px; height: 350px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -40px; left: 5%;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.5rem;
    }
    .hero-title em {
        font-style: italic;
        color: #9fd876;
    }
    .hero-sub {
        font-weight: 300;
        color: rgba(255,255,255,0.75);
        font-size: 1rem;
        letter-spacing: 0.04em;
    }
    .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50px;
        padding: 0.45rem 1.1rem;
        color: rgba(255,255,255,0.9);
        font-size: 0.85rem;
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
        height: 200px;
        object-fit: cover;
    }
    .img-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }
    .card-body-custom { padding: 1.3rem 1.4rem; }

    .autor-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.7rem;
    }
    .autor-avatar {
        width: 26px; height: 26px;
        border-radius: 50%;
        background: var(--verde-medio);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .autor-nombre {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--verde-medio);
    }
    .post-fecha {
        font-size: 0.72rem;
        color: #aaa;
        margin-left: auto;
    }

    .post-titulo {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--cafe);
        margin-bottom: 0.45rem;
        line-height: 1.4;
    }
    .post-contenido {
        font-size: 0.88rem;
        color: #6b7a6b;
        line-height: 1.6;
        margin-bottom: 0.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cats-row {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-bottom: 0.9rem;
    }
    .cat-badge {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        border-radius: 50px;
        padding: 2px 9px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .btn-ver {
        display: inline-block;
        background: #e8f5e9;
        color: var(--verde-bosque);
        border-radius: 8px;
        padding: 0.4rem 1rem;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-ver:hover {
        background: var(--verde-bosque);
        color: #fff;
    }

    .section-label {
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
    .empty-state {
        background: var(--blanco-roto);
        border: 2px dashed rgba(74,124,47,0.25);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
    }

    /* Filtro de categorías */
    .filtro-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 2.5rem;
    }
    .filtro-btn {
        border: 1.5px solid rgba(74,124,47,0.2);
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-size: 0.82rem;
        font-weight: 700;
        background: var(--blanco-roto);
        color: #6b7a6b;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    .filtro-btn:hover,
    .filtro-btn.activo {
        background: var(--verde-bosque);
        color: #fff;
        border-color: var(--verde-bosque);
    }
    .btn-mis-posts {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        border-radius: 50px;
        padding: 0.55rem 1.4rem;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-mis-posts:hover {
        background: rgba(255,255,255,0.22);
        color: #fff;
    }
</style>

<!-- HERO -->
<div class="hero-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p style="font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.55);margin-bottom:0.5rem;">
                    Comunidad de paisajismo
                </p>
                <h1 class="hero-title">Explorar <em>proyectos</em></h1>
                <p class="hero-sub">Descubre el trabajo de toda la comunidad</p>
                <div class="d-flex gap-2 mt-3 flex-wrap">
                    <span class="stat-pill">🌿 {{ $posts->total() }} proyectos</span>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0 d-flex flex-column align-items-md-end gap-2">
                @auth
                    <a href="{{ route('posts.index') }}" class="btn-mis-posts">📁 Mis publicaciones</a>
                    <a href="{{ route('posts.create') }}" class="btn-nueva-pub"
                       style="background:#fff;color:var(--verde-bosque);font-weight:700;padding:0.55rem 1.4rem;border-radius:50px;text-decoration:none;font-size:0.88rem;">
                        ✦ Nueva publicación
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-mis-posts">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- CONTENIDO -->
<div class="container py-5">

    @if($posts->count() > 0)

        <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-2">
            <div>
                <p class="section-label">Comunidad</p>
                <h2 class="section-title">Todos los proyectos</h2>
            </div>
            <span style="color:#8a9e8a;font-size:0.9rem;">
                {{ $posts->total() }} publicación(es)
            </span>
        </div>

        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4" data-cats="{{ $post->categorias->pluck('slug')->join(',') }}">
                <div class="card-post">

                    @if($post->imagen)
                        <img src="{{ asset('storage/' . $post->imagen) }}" alt="{{ $post->titulo }}">
                    @else
                        <div class="img-placeholder">🌿</div>
                    @endif

                    <div class="card-body-custom">

                        <!-- AUTOR -->
                        <div class="autor-row">
                            <div class="autor-avatar">
                                {{ strtoupper(substr($post->user->name ?? 'U', 0, 2)) }}
                            </div>
                            <span class="autor-nombre">{{ $post->user->name ?? 'Usuario' }}</span>
                            <span class="post-fecha">{{ $post->created_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="post-titulo">{{ $post->titulo }}</h3>
                        <p class="post-contenido">{{ $post->contenido }}</p>

                        <!-- CATEGORÍAS -->
                        @if($post->categorias->count())
                        <div class="cats-row">
                            @foreach($post->categorias->take(3) as $cat)
                            <span class="cat-badge" style="background:{{ $cat->color }}18;color:{{ $cat->color }};border:1px solid {{ $cat->color }}35;">
                                {{ $cat->icono }} {{ $cat->nombre }}
                            </span>
                            @endforeach
                            @if($post->categorias->count() > 3)
                            <span class="cat-badge" style="background:#f0f0f0;color:#888;border:1px solid #ddd;">
                                +{{ $post->categorias->count() - 3 }}
                            </span>
                            @endif
                        </div>
                        @endif

                        <a href="{{ route('posts.show', $post) }}" class="btn-ver">Ver proyecto →</a>

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
            <div style="font-size:4rem;margin-bottom:1rem;">🌱</div>
            <h3 style="font-family:'Playfair Display',serif;color:var(--cafe);font-size:1.4rem;margin-bottom:0.5rem;">
                Aún no hay publicaciones
            </h3>
            <p style="color:#8a9e8a;">¡Sé el primero en compartir tu proyecto!</p>
            @auth
            <a href="{{ route('posts.create') }}" class="btn-nueva-pub mt-3 d-inline-block"
               style="background:var(--verde-bosque);color:#fff;padding:0.65rem 1.8rem;border-radius:50px;text-decoration:none;font-weight:700;">
                + Crear primera publicación
            </a>
            @endauth
        </div>
    @endif

</div>

@endsection