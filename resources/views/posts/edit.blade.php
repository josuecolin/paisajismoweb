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
        background: linear-gradient(135deg, var(--tierra) 0%, #a07820 60%, #c49a35 100%);
        padding: 3rem 0 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.3rem;
        font-weight: 700;
        color: #fff;
    }
    .hero-sub {
        font-family: 'Lato', sans-serif;
        font-weight: 300;
        color: rgba(255,255,255,0.82);
        font-size: 1rem;
        letter-spacing: 0.04em;
    }
    .breadcrumb-link {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        transition: color 0.2s;
    }
    .breadcrumb-link:hover { color: #fff; }

    .form-card {
        background: var(--blanco-roto);
        border: 1px solid rgba(139,105,20,0.12);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(139,105,20,0.08);
        overflow: hidden;
    }
    .form-card-header {
        background: rgba(139,105,20,0.06);
        border-bottom: 1px solid rgba(139,105,20,0.1);
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .form-card-header-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        color: var(--tierra);
        margin: 0;
    }
    .badge-editando {
        background: rgba(139,105,20,0.1);
        color: var(--tierra);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        border: 1px solid rgba(139,105,20,0.2);
    }
    .form-card-body { padding: 2rem; }

    .field-label {
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        font-size: 0.82rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--tierra);
        margin-bottom: 0.5rem;
        display: block;
    }
    .field-hint { font-size: 0.8rem; color: #8a9e8a; margin-top: 0.3rem; }

    .input-custom {
        width: 100%;
        border: 1.5px solid rgba(139,105,20,0.2);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-family: 'Lato', sans-serif;
        font-size: 0.95rem;
        color: var(--cafe);
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .input-custom::placeholder { color: #b5c5b5; }
    .input-custom:focus {
        border-color: var(--tierra);
        box-shadow: 0 0 0 3px rgba(139,105,20,0.1);
    }
    .input-custom.is-invalid { border-color: #dc3545; }

    textarea.input-custom { resize: vertical; min-height: 130px; }

    .imagen-actual {
        border-radius: 12px;
        overflow: hidden;
        border: 1.5px solid rgba(139,105,20,0.15);
        margin-bottom: 1rem;
        position: relative;
    }
    .imagen-actual img {
        width: 100%; 
        max-height: 220px; 
        object-fit: cover; 
        display: block;
    }
    .imagen-actual-badge {
        position: absolute;
        top: 10px; left: 10px;
        background: rgba(0,0,0,0.55);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.3rem 0.7rem;
        border-radius: 50px;
    }

    .file-upload-wrapper {
        border: 2px dashed rgba(139,105,20,0.25);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        background: rgba(139,105,20,0.03);
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
    }
    .file-upload-wrapper:hover {
        border-color: var(--tierra);
        background: rgba(139,105,20,0.06);
    }
    .file-upload-wrapper input[type="file"] {
        position: absolute; inset: 0;
        opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .file-icon { font-size: 1.5rem; margin-bottom: 0.3rem; display: block; }
    .file-text { color: var(--tierra); font-weight: 700; font-size: 0.88rem; }
    .file-sub { color: #8a9e8a; font-size: 0.78rem; margin-top: 0.2rem; }
    .preview-img {
        max-height: 180px;
        border-radius: 10px;
        margin-top: 0.8rem;
        display: none;
        object-fit: cover;
        width: 100%;
    }

    .field-separator {
        height: 1px;
        background: rgba(139,105,20,0.1);
        margin: 1.8rem 0;
    }

    .btn-guardar {
        background: var(--tierra);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2.2rem;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.05em;
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-guardar:hover {
        background: #6b4f0e;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(139,105,20,0.3);
    }
    .btn-volver {
        background: transparent;
        color: #8a9e8a;
        border: 1.5px solid rgba(139,105,20,0.2);
        border-radius: 50px;
        padding: 0.75rem 1.8rem;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        letter-spacing: 0.03em;
        transition: all 0.2s;
    }
    .btn-volver:hover {
        border-color: var(--tierra);
        color: var(--tierra);
    }
    .btn-ver-pub {
        background: transparent;
        color: var(--verde-medio);
        border: 1.5px solid rgba(74,124,47,0.25);
        border-radius: 50px;
        padding: 0.6rem 1.4rem;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-ver-pub:hover {
        background: var(--verde-medio);
        color: #fff;
        border-color: var(--verde-medio);
    }
    .error-msg { color: #b91c1c; font-size: 0.82rem; margin-top: 0.35rem; font-weight: 600; }
    .meta-info {
        background: rgba(139,105,20,0.05);
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 0.82rem;
        color: #8a7060;
    }
    .meta-info span { font-weight: 700; color: var(--tierra); }
</style>

<!-- HERO -->
<div class="hero-banner">
    <div class="container">
        <nav style="margin-bottom:1rem;">
            <a href="{{ route('posts.index') }}" class="breadcrumb-link">← Publicaciones</a>
            <span style="color:rgba(255,255,255,0.4);margin:0 0.5rem;">/</span>
            <a href="{{ route('posts.show', $post) }}" class="breadcrumb-link">{{ Str::limit($post->titulo, 30) }}</a>
            <span style="color:rgba(255,255,255,0.4);margin:0 0.5rem;">/</span>
            <span style="color:rgba(255,255,255,0.85);font-size:0.85rem;">Editar</span>
        </nav>
        <h1 class="hero-title">✏️ Editar publicación</h1>
        <p class="hero-sub">Actualiza los detalles de tu proyecto</p>
    </div>
</div>

<!-- FORMULARIO -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            @if($errors->any())
            <div class="alert mb-4" style="background:#fde8e8;border:1px solid rgba(185,28,28,0.2);border-radius:12px;color:#b91c1c;font-weight:600;">
                <strong>⚠️ Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- META INFO -->
            <div class="meta-info mb-4">
                📅 Publicado el <span>{{ $post->created_at->format('d \d\e F \d\e Y') }}</span>
                &nbsp;·&nbsp;
                🔄 Última edición: <span>{{ $post->updated_at->diffForHumans() }}</span>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <h2 class="form-card-header-title">📋 Editar datos</h2>
                    <span class="badge-editando">Modo edición</span>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- TÍTULO -->
                        <div class="mb-4">
                            <label class="field-label" for="titulo">🌿 Título del proyecto</label>
                            <input 
                                type="text" 
                                id="titulo"
                                name="titulo" 
                                class="input-custom {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                                value="{{ old('titulo', $post->titulo) }}"
                                placeholder="Título del proyecto">
                            @error('titulo')
                                <p class="error-msg">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-separator"></div>

                        <!-- CONTENIDO -->
                        <div class="mb-4">
                            <label class="field-label" for="contenido">🪴 Descripción del diseño</label>
                            <textarea 
                                id="contenido"
                                name="contenido" 
                                class="input-custom {{ $errors->has('contenido') ? 'is-invalid' : '' }}">{{ old('contenido', $post->contenido) }}</textarea>
                            @error('contenido')
                                <p class="error-msg">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-separator"></div>

                        <!-- IMAGEN -->
                        <div class="mb-4">
                            <label class="field-label">📸 Imagen del diseño</label>

                            @if($post->imagen)
                            <div class="imagen-actual">
                                <img src="{{ asset('storage/' . $post->imagen) }}" alt="{{ $post->titulo }}">
                                <span class="imagen-actual-badge">Imagen actual</span>
                            </div>
                            <p class="field-hint mb-2">Sube una nueva imagen para reemplazarla, o déjala vacía para conservar la actual.</p>
                            @endif

                            <div class="file-upload-wrapper">
                                <input type="file" name="imagen" id="imagenInput" accept="image/*"
                                       onchange="previewImagen(event)">
                                <span class="file-icon">🔄</span>
                                <p class="file-text">{{ $post->imagen ? 'Cambiar imagen' : 'Subir imagen' }}</p>
                                <p class="file-sub">PNG, JPG, WEBP — máximo 2MB</p>
                            </div>
                            <img id="previewImg" class="preview-img" src="#" alt="Vista previa">
                            @error('imagen')
                                <p class="error-msg">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field-separator"></div>

                        <!-- BOTONES -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.index') }}" class="btn-volver">← Volver</a>
                                <a href="{{ route('posts.show', $post) }}" class="btn-ver-pub">Ver publicación</a>
                            </div>
                            <button type="submit" class="btn-guardar">💾 Guardar cambios</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewImagen(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImg');
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection