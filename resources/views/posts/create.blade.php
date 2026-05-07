@extends('layouts.app')
 
@section('content')
 
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap');
    :root {
        --verde-bosque: #2D5016; --verde-medio: #4A7C2F; --verde-claro: #7AAD52;
        --crema: #F5F0E8; --tierra: #8B6914; --cafe: #3D2B1F; --blanco-roto: #FDFAF5;
    }
    body { background-color: var(--crema); font-family: 'Lato', sans-serif; }
    .hero-banner {
        background: linear-gradient(135deg, var(--verde-bosque) 0%, var(--verde-medio) 60%, var(--verde-claro) 100%);
        padding: 3rem 0 2.5rem; position: relative; overflow: hidden;
    }
    .hero-banner::before {
        content: ''; position: absolute; top: -40px; right: -40px;
        width: 260px; height: 260px; border-radius: 50%; background: rgba(255,255,255,0.05);
    }
    .hero-title { font-family: 'Playfair Display', serif; font-size: 2.3rem; font-weight: 700; color: #fff; }
    .hero-sub { font-weight: 300; color: rgba(255,255,255,0.82); font-size: 1rem; letter-spacing: 0.04em; }
    .breadcrumb-link { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
    .breadcrumb-link:hover { color: #fff; }
    .form-card { background: var(--blanco-roto); border: 1px solid rgba(74,124,47,0.12); border-radius: 20px; box-shadow: 0 8px 32px rgba(45,80,22,0.08); overflow: hidden; }
    .form-card-header { background: rgba(74,124,47,0.06); border-bottom: 1px solid rgba(74,124,47,0.1); padding: 1.5rem 2rem; }
    .form-card-header-title { font-family: 'Playfair Display', serif; font-size: 1.25rem; color: var(--verde-bosque); margin: 0; }
    .form-card-body { padding: 2rem; }
    .field-label { font-weight: 700; font-size: 0.82rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--verde-medio); margin-bottom: 0.5rem; display: block; }
    .field-hint { font-size: 0.8rem; color: #8a9e8a; margin-top: 0.3rem; }
    .input-custom { width: 100%; border: 1.5px solid rgba(74,124,47,0.2); border-radius: 10px; padding: 0.75rem 1rem; font-family: 'Lato', sans-serif; font-size: 0.95rem; color: var(--cafe); background: #fff; transition: border-color 0.2s, box-shadow 0.2s; outline: none; }
    .input-custom::placeholder { color: #b5c5b5; }
    .input-custom:focus { border-color: var(--verde-medio); box-shadow: 0 0 0 3px rgba(74,124,47,0.12); }
    .input-custom.is-invalid { border-color: #dc3545; }
    textarea.input-custom { resize: vertical; min-height: 130px; }
    .file-upload-wrapper { border: 2px dashed rgba(74,124,47,0.25); border-radius: 12px; padding: 1.8rem; text-align: center; background: rgba(74,124,47,0.03); transition: all 0.2s; cursor: pointer; position: relative; }
    .file-upload-wrapper:hover { border-color: var(--verde-medio); background: rgba(74,124,47,0.06); }
    .file-upload-wrapper input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .preview-img { max-height: 200px; border-radius: 10px; margin-top: 1rem; display: none; object-fit: cover; width: 100%; }
    .field-separator { height: 1px; background: rgba(74,124,47,0.1); margin: 1.8rem 0; }
    .btn-publicar { background: var(--verde-bosque); color: #fff; border: none; border-radius: 50px; padding: 0.75rem 2.2rem; font-family: 'Lato', sans-serif; font-weight: 700; font-size: 0.95rem; letter-spacing: 0.05em; transition: all 0.25s; cursor: pointer; }
    .btn-publicar:hover { background: var(--verde-medio); transform: translateY(-2px); box-shadow: 0 6px 18px rgba(45,80,22,0.25); }
    .btn-volver { background: transparent; color: #8a9e8a; border: 1.5px solid rgba(74,124,47,0.2); border-radius: 50px; padding: 0.75rem 1.8rem; font-family: 'Lato', sans-serif; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.2s; }
    .btn-volver:hover { border-color: var(--verde-medio); color: var(--verde-bosque); }
    .error-msg { color: #b91c1c; font-size: 0.82rem; margin-top: 0.35rem; font-weight: 600; }
    .tip-card { background: rgba(74,124,47,0.06); border-left: 3px solid var(--verde-claro); border-radius: 0 10px 10px 0; padding: 1rem 1.2rem; }
    .tip-card p { margin: 0; font-size: 0.85rem; color: #4a6040; line-height: 1.6; }
</style>
 
<div class="hero-banner">
    <div class="container">
        <nav style="margin-bottom:1rem;">
            <a href="{{ route('posts.index') }}" class="breadcrumb-link">← Publicaciones</a>
            <span style="color:rgba(255,255,255,0.4);margin:0 0.5rem;">/</span>
            <span style="color:rgba(255,255,255,0.85);font-size:0.85rem;">Nueva publicación</span>
        </nav>
        <h1 class="hero-title">🌱 Crear publicación</h1>
        <p class="hero-sub">Comparte tu proyecto y transforma espacios</p>
    </div>
</div>
 
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
 
            @if($errors->any())
            <div class="alert mb-4" style="background:#fde8e8;border:1px solid rgba(185,28,28,0.2);border-radius:12px;color:#b91c1c;font-weight:600;">
                <strong>⚠️ Corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
 
            <div class="form-card">
                <div class="form-card-header">
                    <h2 class="form-card-header-title">📋 Datos de la publicación</h2>
                </div>
                <div class="form-card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
 
                        <!-- TÍTULO -->
                        <div class="mb-4">
                            <label class="field-label" for="titulo">🌿 Título del proyecto</label>
                            <input type="text" id="titulo" name="titulo"
                                class="input-custom {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                                value="{{ old('titulo') }}"
                                placeholder="Ej. Jardín zen con bambú y piedra volcánica">
                            @error('titulo')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
 
                        <div class="field-separator"></div>
 
                        <!-- CONTENIDO -->
                        <div class="mb-4">
                            <label class="field-label" for="contenido">🪴 Descripción del diseño</label>
                            <textarea id="contenido" name="contenido"
                                class="input-custom {{ $errors->has('contenido') ? 'is-invalid' : '' }}"
                                placeholder="Describe el estilo, plantas utilizadas, materiales...">{{ old('contenido') }}</textarea>
                            @error('contenido')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
 
                        <div class="field-separator"></div>
 
                        <!-- CATEGORÍAS -->
                        <div class="mb-4">
                            <label class="field-label">🏷️ Categorías de la publicación</label>
                            <p class="field-hint mb-2">Selecciona las categorías que mejor describen tu proyecto.</p>
 
                            @include('partials.categoria-selector', [
                                'categorias'    => $categorias,
                                'seleccionadas' => old('categorias', []),
                            ])
                        </div>
 
                        <div class="field-separator"></div>
 
                        <!-- IMAGEN -->
                        <div class="mb-4">
                            <label class="field-label">📸 Imagen del diseño</label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="imagen" id="imagenInput" accept="image/*"
                                       onchange="previewImagen(event)">
                                <span style="font-size:2rem;display:block;margin-bottom:0.4rem;">🖼️</span>
                                <p style="color:var(--verde-medio);font-weight:700;font-size:0.9rem;margin:0;">Haz clic o arrastra una imagen</p>
                                <p style="color:#8a9e8a;font-size:0.78rem;margin:0.2rem 0 0;">PNG, JPG, WEBP — máx. 2MB</p>
                            </div>
                            <img id="previewImg" class="preview-img" src="#" alt="Vista previa">
                            @error('imagen')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
 
                        <div class="field-separator"></div>
 
                        <div class="tip-card mb-4">
                            <p>💡 <strong>Consejo:</strong> Las publicaciones con categorías bien definidas reciben hasta 3x más visitas. ¡Elige las que mejor representen tu diseño!</p>
                        </div>
 
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('posts.index') }}" class="btn-volver">← Volver</a>
                            <button type="submit" class="btn-publicar">🌱 Publicar proyecto</button>
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
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(file);
    }
}
</script>
 
@endsection