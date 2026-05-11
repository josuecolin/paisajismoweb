@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap');

    :root {
        --verde-bosque: #2D5016;
        --verde-medio:  #4A7C2F;
        --verde-claro:  #7AAD52;
        --crema:        #F5F0E8;
        --cafe:         #3D2B1F;
        --blanco-roto:  #FDFAF5;
    }

    body { background: var(--crema); font-family: 'Lato', sans-serif; }

    .hero-banner {
        background: linear-gradient(135deg, #2a1a0e 0%, #4a3010 50%, #6b4a1a 100%);
        padding: 4rem 0 3rem;
        position: relative;
        overflow: hidden;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
    }
    .hero-title em { font-style: italic; color: #f0c878; }
    .hero-sub { color: rgba(255,255,255,0.7); font-weight: 300; }
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
        transition: transform 0.25s, box-shadow 0.25s;
        height: 100%;
    }
    .card-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(45,80,22,0.13);
    }
    .card-post img { width: 100%; height: 200px; object-fit: cover; }
    .img-placeholder {
        width: 100%; height: 200px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        display: flex; align-items: center; justify-content: center;
        font-size: 3rem;
    }
    .card-body-custom { padding: 1.3rem 1.4rem; }

    .autor-row { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.7rem; }
    .autor-avatar {
        width: 26px; height: 26px; border-radius: 50%;
        background: var(--verde-medio); color: #fff;
        font-size: 0.65rem; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }
    .autor-nombre { font-size: 0.8rem; font-weight: 700; color: var(--verde-medio); }
    .post-fecha { font-size: 0.72rem; color: #aaa; margin-left: auto; }

    .post-titulo {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem; font-weight: 600;
        color: var(--cafe); margin-bottom: 0.45rem; line-height: 1.4;
    }
    .post-contenido {
        font-size: 0.88rem; color: #6b7a6b; line-height: 1.6;
        margin-bottom: 0.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cats-row { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 0.9rem; }
    .cat-badge {
        border-radius: 50px; padding: 2px 9px;
        font-size: 0.7rem; font-weight: 700;
        display: inline-flex; align-items: center; gap: 3px;
    }
    .btn-ver {
        display: inline-block;
        background: #e8f5e9; color: var(--verde-bosque);
        border-radius: 8px; padding: 0.4rem 1rem;
        font-size: 0.82rem; font-weight: 700;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-ver:hover { background: var(--verde-bosque); color: #fff; }

    .btn-quitar {
        display: inline-flex; align-items: center; gap: 5px;
        background: #fff3f3; border: 1.5px solid rgba(200,50,50,0.2);
        border-radius: 8px; padding: 0.4rem 0.9rem;
        font-size: 0.82rem; font-weight: 700;
        color: #c0392b; cursor: pointer; transition: all 0.2s;
    }
    .btn-quitar:hover { background: #c0392b; color: #fff; border-color: #c0392b; }

    .empty-state {
        background: var(--blanco-roto);
        border: 2px dashed rgba(74,124,47,0.25);
        border-radius: 20px;
        padding: 5rem 2rem; text-align: center;
    }
    .section-label {
        font-size: 0.75rem; letter-spacing: 0.18em;
        text-transform: uppercase; color: var(--verde-medio);
        font-weight: 700; margin-bottom: 0.3rem;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.9rem; color: var(--cafe); font-weight: 600;
    }
</style>

<!-- HERO -->
<div class="hero-banner">
    <div class="container">
        <p style="font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:0.5rem;">
            Mi colección
        </p>
        <h1 class="hero-title">Proyectos <em>guardados</em></h1>
        <p class="hero-sub">Todo lo que has marcado para inspirarte</p>
        <div class="mt-3">
            <span class="stat-pill">🔖 {{ $posts->total() }} guardados</span>
        </div>
    </div>
</div>

<!-- CONTENIDO -->
<div class="container py-5">

    @if(session('guardado_status'))
    <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4" role="alert"
         style="background:rgba(45,80,22,0.08);color:var(--verde-bosque);">
        🌿 {{ session('guardado_status') === 'removido' ? 'Publicación eliminada de guardados.' : 'Publicación guardada correctamente.' }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($posts->count() > 0)

        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                <p class="section-label">Mi colección</p>
                <h2 class="section-title">Guardados</h2>
            </div>
            <a href="{{ route('posts.explorar') }}"
               style="color:var(--verde-medio);font-weight:700;font-size:0.88rem;text-decoration:none;">
                ← Seguir explorando
            </a>
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

                        <div class="autor-row">
                            <div class="autor-avatar">
                                {{ strtoupper(substr($post->user->name ?? 'U', 0, 2)) }}
                            </div>
                            <span class="autor-nombre">{{ $post->user->name ?? 'Usuario' }}</span>
                            <span class="post-fecha">{{ $post->created_at->format('d M Y') }}</span>
                        </div>

                        <h3 class="post-titulo">{{ $post->titulo }}</h3>
                        <p class="post-contenido">{{ $post->contenido }}</p>

                        @if($post->categorias->count())
                        <div class="cats-row">
                            @foreach($post->categorias->take(3) as $cat)
                            <span class="cat-badge"
                                  style="background:{{ $cat->color }}18;color:{{ $cat->color }};border:1px solid {{ $cat->color }}35;">
                                {{ $cat->icono }} {{ $cat->nombre }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('posts.show', $post) }}" class="btn-ver">
                                Ver proyecto →
                            </a>
                            <form method="POST" action="{{ route('posts.guardar', $post) }}">
                                @csrf
                                <button type="submit" class="btn-quitar">
                                    🗑 Quitar
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
            <div style="font-size:4rem;margin-bottom:1rem;">🔖</div>
            <h3 style="font-family:'Playfair Display',serif;color:var(--cafe);font-size:1.5rem;margin-bottom:0.5rem;">
                Aún no tienes guardados
            </h3>
            <p style="color:#8a9e8a;margin-bottom:1.5rem;">
                Explora proyectos y guarda los que más te inspiren
            </p>
            <a href="{{ route('posts.explorar') }}"
               style="background:var(--verde-bosque);color:#fff;padding:0.7rem 2rem;border-radius:50px;text-decoration:none;font-weight:700;">
                Explorar proyectos
            </a>
        </div>
    @endif

</div>

@endsection