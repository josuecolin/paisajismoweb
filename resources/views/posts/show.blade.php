@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Lato:wght@300;400;700&display=swap');

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

    .hero-imagen {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
    }
    .hero-placeholder {
        width: 100%;
        height: 320px;
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #a5d6a7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
    }
    .hero-overlay {
        background: linear-gradient(to top, rgba(45,80,22,0.85) 0%, transparent 60%);
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 220px;
        pointer-events: none;
    }
    .hero-wrapper { position: relative; }
    .hero-content {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 2rem;
    }

    .post-titulo-hero {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 700;
        color: #fff;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }
    .post-fecha-hero {
        color: rgba(255,255,255,0.8);
        font-size: 0.85rem;
        font-weight: 300;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .breadcrumb-link {
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        font-size: 0.85rem;
        background: rgba(0,0,0,0.25);
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
        transition: background 0.2s;
        display: inline-block;
        margin-bottom: 1rem;
    }
    .breadcrumb-link:hover { background: rgba(0,0,0,0.4); color: #fff; }

    .contenido-card {
        background: var(--blanco-roto);
        border: 1px solid rgba(74,124,47,0.1);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(45,80,22,0.07);
        margin-top: -3rem;
        position: relative;
        z-index: 10;
    }
    .post-contenido-body {
        font-family: 'Lato', sans-serif;
        font-size: 1.05rem;
        line-height: 1.85;
        color: #4a5a4a;
        white-space: pre-line;
    }
    .autor-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(74,124,47,0.08);
        border: 1px solid rgba(74,124,47,0.15);
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
        color: var(--verde-bosque);
        font-weight: 700;
    }
    .autor-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: var(--verde-medio);
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .divider-ornamental {
        text-align: center;
        margin: 2rem 0;
        position: relative;
    }
    .divider-ornamental::before {
        content: '';
        position: absolute;
        top: 50%; left: 0; right: 0;
        height: 1px;
        background: rgba(74,124,47,0.15);
    }
    .divider-ornamental span {
        background: var(--blanco-roto);
        padding: 0 1rem;
        position: relative;
        color: var(--verde-claro);
        font-size: 1.2rem;
    }

    .acciones-panel {
        background: var(--blanco-roto);
        border: 1px solid rgba(74,124,47,0.1);
        border-radius: 16px;
        padding: 1.5rem;
        position: sticky;
        top: 1.5rem;
    }
    .acciones-title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: var(--cafe);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .btn-accion-panel {
        display: block;
        width: 100%;
        padding: 0.7rem 1.2rem;
        border-radius: 10px;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        letter-spacing: 0.03em;
        text-align: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 0.6rem;
    }
    .btn-editar-panel {
        background: rgba(139,105,20,0.1);
        color: var(--tierra);
        border: 1.5px solid rgba(139,105,20,0.2);
    }
    .btn-editar-panel:hover { background: var(--tierra); color: #fff; }
    .btn-eliminar-panel {
        background: rgba(185,28,28,0.07);
        color: #b91c1c;
        border: 1.5px solid rgba(185,28,28,0.15);
    }
    .btn-eliminar-panel:hover { background: #b91c1c; color: #fff; }
    .btn-volver-panel {
        background: transparent;
        color: #8a9e8a;
        border: 1.5px solid rgba(74,124,47,0.2);
    }
    .btn-volver-panel:hover { border-color: var(--verde-medio); color: var(--verde-bosque); }

    .tag-paisajismo {
        display: inline-block;
        background: rgba(74,124,47,0.1);
        color: var(--verde-bosque);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        margin-right: 0.4rem;
        margin-bottom: 0.4rem;
    }
</style>

<!-- IMAGEN HERO -->
<div class="hero-wrapper">
    @if($post->imagen)
        <img src="{{ asset('storage/' . $post->imagen) }}" 
             alt="{{ $post->titulo }}" class="hero-imagen">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <a href="{{ route('posts.index') }}" class="breadcrumb-link">← Publicaciones</a>
                <h1 class="post-titulo-hero">{{ $post->titulo }}</h1>
                <p class="post-fecha-hero">Publicado el {{ $post->created_at->format('d \d\e F \d\e Y') }}</p>
            </div>
        </div>
    @else
        <div class="hero-placeholder">🌿</div>
    @endif
</div>

<!-- CONTENIDO -->
<div class="container py-4">
    <div class="row g-4">

        <!-- COLUMNA PRINCIPAL -->
        <div class="col-lg-8">

            @if(!$post->imagen)
            <div class="mb-3">
                <a href="{{ route('posts.index') }}" style="color:var(--verde-medio);font-weight:700;text-decoration:none;font-size:0.9rem;">← Publicaciones</a>
            </div>
            <h1 style="font-family:'Playfair Display',serif;font-size:2rem;color:var(--cafe);font-weight:700;margin-bottom:0.5rem;">{{ $post->titulo }}</h1>
            <p style="color:#8a9e8a;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;font-weight:700;">
                Publicado el {{ $post->created_at->format('d \d\e F \d\e Y') }}
            </p>
            @endif

            <div class="contenido-card">

                <!-- AUTOR Y TAGS -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    @if($post->user)
                    <div class="autor-chip">
                        <div class="autor-avatar">
                            {{ strtoupper(substr($post->user->name, 0, 2)) }}
                        </div>
                        {{ $post->user->name }}
                    </div>
                    @endif
                    <div>
                        <span class="tag-paisajismo">Paisajismo</span>
                        <span class="tag-paisajismo">Diseño</span>
                    </div>
                </div>

                <div class="divider-ornamental"><span>❧</span></div>

                <!-- CONTENIDO -->
                <div class="post-contenido-body">
                    {{ $post->contenido }}
                </div>

                <div class="divider-ornamental"><span>✦</span></div>

                <!-- FOOTER DEL POST -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <span style="font-size:0.8rem;color:#8a9e8a;">
                        🕐 Última actualización: {{ $post->updated_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('posts.edit', $post) }}" 
                       style="color:var(--tierra);font-weight:700;text-decoration:none;font-size:0.85rem;">
                        ✏️ Editar esta publicación
                    </a>
                </div>
            </div>
        </div>

        <!-- PANEL ACCIONES -->
        <div class="col-lg-4">
            <div class="acciones-panel">
                <p class="acciones-title">⚙️ Acciones</p>

                <a href="{{ route('posts.edit', $post) }}" class="btn-accion-panel btn-editar-panel">
                    ✏️ Editar publicación
                </a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta publicación? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-accion-panel btn-eliminar-panel">
                        🗑️ Eliminar publicación
                    </button>
                </form>

                <div style="height:1px;background:rgba(74,124,47,0.1);margin:0.8rem 0;"></div>

                <a href="{{ route('posts.index') }}" class="btn-accion-panel btn-volver-panel">
                    ← Volver al listado
                </a>
                <a href="{{ route('posts.create') }}" class="btn-accion-panel" 
                   style="background:rgba(74,124,47,0.1);color:var(--verde-bosque);border:1.5px solid rgba(74,124,47,0.2);display:block;width:100%;padding:0.7rem 1.2rem;border-radius:10px;font-weight:700;font-size:0.88rem;text-align:center;text-decoration:none;transition:all 0.2s;"
                   onmouseover="this.style.background='var(--verde-bosque)';this.style.color='#fff';"
                   onmouseout="this.style.background='rgba(74,124,47,0.1)';this.style.color='var(--verde-bosque)';">
                    🌱 Nueva publicación
                </a>

                <!-- META INFO -->
                <div style="margin-top:1.2rem;padding:1rem;background:rgba(74,124,47,0.04);border-radius:10px;">
                    <p style="font-size:0.78rem;color:#8a9e8a;margin:0 0 0.4rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;">Info</p>
                    <p style="font-size:0.82rem;color:#6b7a6b;margin:0 0 0.3rem;">
                        📅 <strong>Creado:</strong> {{ $post->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p style="font-size:0.82rem;color:#6b7a6b;margin:0;">
                        🔄 <strong>Modificado:</strong> {{ $post->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection