@extends('layouts.app')
 
@section('content')
 
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');
 
    :root {
        --bosque:   #1C3A12;
        --verde:    #3D6B27;
        --hoja:     #6FA845;
        --musgo:    #8FAF6A;
        --crema:    #F4EFE4;
        --arena:    #E8DEC8;
        --tierra:   #7A5C2E;
        --cafe:     #2E1F0E;
        --blanco:   #FDFAF4;
    }
 
    * { box-sizing: border-box; }
    body {
        background: var(--crema);
        font-family: 'DM Sans', sans-serif;
        margin: 0;
    }
 
    /* ── HERO ── */
    .pref-hero {
        background: var(--bosque);
        padding: 5rem 0 6rem;
        position: relative;
        overflow: hidden;
    }
    .pref-hero-rings {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 700px; height: 700px;
        border-radius: 50%;
        border: 1px solid rgba(111,168,69,0.12);
        pointer-events: none;
    }
    .pref-hero-rings::before {
        content: '';
        position: absolute;
        top: 10%; left: 10%;
        right: 10%; bottom: 10%;
        border-radius: 50%;
        border: 1px solid rgba(111,168,69,0.08);
    }
    .pref-hero-rings::after {
        content: '';
        position: absolute;
        top: 22%; left: 22%;
        right: 22%; bottom: 22%;
        border-radius: 50%;
        border: 1px solid rgba(111,168,69,0.06);
    }
    .pref-hero-dot {
        position: absolute;
        border-radius: 50%;
        background: rgba(111,168,69,0.07);
    }
    .dot-1 { width: 160px; height: 160px; top: -30px; right: 8%; }
    .dot-2 { width: 90px;  height: 90px;  bottom: 20px; left: 5%; }
    .dot-3 { width: 50px;  height: 50px;  top: 40%; right: 20%; }
 
    .pref-hero .container { position: relative; z-index: 2; text-align: center; }
 
    .pref-eyebrow {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--musgo);
        margin-bottom: 1rem;
        display: block;
    }
    .pref-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2.6rem, 5vw, 3.8rem);
        font-weight: 600;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 1rem;
    }
    .pref-title em { font-style: italic; color: var(--musgo); }
    .pref-subtitle {
        font-size: 1rem;
        color: rgba(255,255,255,0.6);
        font-weight: 300;
        max-width: 460px;
        margin: 0 auto;
        line-height: 1.7;
    }
 
    /* ── WAVE ── */
    .wave-divider {
        display: block;
        width: 100%;
        margin-bottom: -2px;
        color: var(--crema);
    }
 
    /* ── ALERT ── */
    .alert-pref {
        background: rgba(61,107,39,0.1);
        border: 1px solid rgba(61,107,39,0.2);
        border-radius: 12px;
        color: var(--verde);
        font-weight: 500;
        padding: 0.85rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }
 
    /* ── COUNTER BADGE ── */
    .counter-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .counter-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--cafe);
    }
    .counter-badge {
        background: var(--bosque);
        color: var(--musgo);
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        padding: 0.45rem 1.1rem;
        border-radius: 50px;
        transition: background 0.2s;
    }
    .counter-badge.has-selection { background: var(--verde); color: #fff; }
 
    /* ── GRID DE CATEGORÍAS ── */
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }
 
    /* ── TARJETA DE CATEGORÍA ── */
    .cat-card {
        position: relative;
        cursor: pointer;
        user-select: none;
    }
    .cat-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
        pointer-events: none;
    }
    .cat-label {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.2rem 1.3rem;
        background: var(--blanco);
        border: 1.5px solid rgba(0,0,0,0.07);
        border-radius: 16px;
        transition: all 0.22s ease;
        cursor: pointer;
        height: 100%;
    }
    .cat-card input:checked + .cat-label {
        border-color: var(--hoja);
        background: rgba(111,168,69,0.06);
        box-shadow: 0 0 0 3px rgba(111,168,69,0.15);
    }
    .cat-label:hover {
        border-color: rgba(111,168,69,0.4);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(28,58,18,0.1);
    }
 
    .cat-icon-wrap {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
        transition: transform 0.2s;
    }
    .cat-card input:checked + .cat-label .cat-icon-wrap {
        transform: scale(1.1);
    }
 
    .cat-info { flex: 1; min-width: 0; }
    .cat-nombre {
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--cafe);
        margin: 0 0 0.2rem;
        line-height: 1.3;
    }
    .cat-desc {
        font-size: 0.78rem;
        color: #8a9e8a;
        line-height: 1.5;
        margin: 0;
    }
 
    .cat-check {
        width: 20px; height: 20px;
        border-radius: 50%;
        border: 1.5px solid rgba(0,0,0,0.12);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        margin-top: 2px;
        background: #fff;
    }
    .cat-card input:checked + .cat-label .cat-check {
        background: var(--hoja);
        border-color: var(--hoja);
    }
    .cat-check-inner {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #fff;
        opacity: 0;
        transform: scale(0);
        transition: all 0.18s;
    }
    .cat-card input:checked + .cat-label .cat-check-inner {
        opacity: 1;
        transform: scale(1);
    }
 
    /* ── PANEL INFERIOR ── */
    .bottom-panel {
        background: var(--blanco);
        border: 1px solid rgba(61,107,39,0.1);
        border-radius: 20px;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 4rem;
        box-shadow: 0 4px 24px rgba(28,58,18,0.06);
    }
    .bottom-panel-text { color: #7a8a7a; font-size: 0.9rem; max-width: 360px; }
    .bottom-panel-text strong { color: var(--cafe); }
 
    .btn-guardar {
        background: var(--bosque);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 0.85rem 2.5rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.03em;
        cursor: pointer;
        transition: all 0.25s;
        white-space: nowrap;
    }
    .btn-guardar:hover:not(:disabled) {
        background: var(--verde);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(28,58,18,0.25);
    }
    .btn-guardar:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }
    .btn-omitir {
        color: #8a9e8a;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        transition: color 0.2s;
    }
    .btn-omitir:hover { color: var(--verde); }
 
    /* ── SELECCIÓN FLOTANTE ── */
    .chips-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        min-height: 36px;
        margin-bottom: 2rem;
    }
    .chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(61,107,39,0.1);
        color: var(--verde);
        border: 1px solid rgba(61,107,39,0.2);
        border-radius: 50px;
        padding: 0.3rem 0.85rem;
        font-size: 0.8rem;
        font-weight: 500;
        animation: chipIn 0.2s ease;
    }
    @keyframes chipIn {
        from { opacity: 0; transform: scale(0.8); }
        to   { opacity: 1; transform: scale(1); }
    }
 
    /* ── SEPARADOR ── */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.8rem;
    }
    .section-divider::before, .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(0,0,0,0.07);
    }
    .section-divider span {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #b5c5b5;
    }
</style>
 
<!-- HERO -->
<div class="pref-hero">
    <div class="pref-hero-rings"></div>
    <div class="pref-hero-dot dot-1"></div>
    <div class="pref-hero-dot dot-2"></div>
    <div class="pref-hero-dot dot-3"></div>
    <div class="container">
        <span class="pref-eyebrow">Perfil de paisajismo</span>
        <h1 class="pref-title">¿Qué tipo de <em>jardines</em><br>te inspiran?</h1>
        <p class="pref-subtitle">Elige tus categorías favoritas y personalizaremos tu experiencia con publicaciones afines a tu estilo.</p>
    </div>
</div>
 
<svg class="wave-divider" viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="currentColor"/>
</svg>
 
<!-- CONTENIDO -->
<div class="container py-4">
    <div style="max-width: 860px; margin: 0 auto;">
 
        @if(session('success'))
        <div class="alert-pref">
            <span>🌿</span> {{ session('success') }}
        </div>
        @endif
 
        <form action="{{ route('categorias.guardarPreferencias') }}" method="POST" id="prefForm">
            @csrf
 
            <!-- CONTADOR -->
            <div class="counter-wrap">
                <p class="counter-text">Elige tus categorías</p>
                <span class="counter-badge" id="counterBadge">0 seleccionadas</span>
            </div>
 
            <!-- CHIPS DE SELECCIÓN -->
            <div class="chips-container" id="chipsContainer">
                <span style="color:#b5c5b5;font-size:0.85rem;align-self:center;">
                    Tus selecciones aparecerán aquí…
                </span>
            </div>
 
            <div class="section-divider"><span>Categorías disponibles</span></div>
 
            <!-- GRID DE CATEGORÍAS -->
            <div class="cat-grid">
                @foreach($categorias as $cat)
                <div class="cat-card">
                    <input 
                        type="checkbox" 
                        name="categorias[]" 
                        id="cat_{{ $cat->id }}"
                        value="{{ $cat->id }}"
                        data-nombre="{{ $cat->nombre }}"
                        data-icono="{{ $cat->icono }}"
                        {{ in_array($cat->id, $seleccionadas) ? 'checked' : '' }}
                    >
                    <label class="cat-label" for="cat_{{ $cat->id }}">
                        <div class="cat-icon-wrap" style="background: {{ $cat->color }}22;">
                            <span>{{ $cat->icono }}</span>
                        </div>
                        <div class="cat-info">
                            <p class="cat-nombre">{{ $cat->nombre }}</p>
                            @if($cat->descripcion)
                            <p class="cat-desc">{{ Str::limit($cat->descripcion, 70) }}</p>
                            @endif
                        </div>
                        <div class="cat-check">
                            <div class="cat-check-inner"></div>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
 
            <!-- PANEL INFERIOR -->
            <div class="bottom-panel">
                <div>
                    <p class="bottom-panel-text">
                        <strong>Puedes cambiar tus preferencias en cualquier momento.</strong>
                        Usaremos estas categorías para mostrarte el contenido más relevante.
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('posts.index') }}" class="btn-omitir">Omitir por ahora</a>
                    <button type="submit" class="btn-guardar" id="btnGuardar" disabled>
                        Guardar preferencias
                    </button>
                </div>
            </div>
 
        </form>
    </div>
</div>
 
<script>
(function () {
    const checkboxes   = document.querySelectorAll('.cat-card input[type="checkbox"]');
    const badge        = document.getElementById('counterBadge');
    const btnGuardar   = document.getElementById('btnGuardar');
    const chipsWrap    = document.getElementById('chipsContainer');
 
    function actualizarUI() {
        const checked = [...checkboxes].filter(c => c.checked);
        const n = checked.length;
 
        // Badge contador
        badge.textContent = n === 0 ? '0 seleccionadas'
                          : n === 1 ? '1 seleccionada'
                          : `${n} seleccionadas`;
        badge.classList.toggle('has-selection', n > 0);
 
        // Botón guardar
        btnGuardar.disabled = n === 0;
 
        // Chips
        chipsWrap.innerHTML = '';
        if (n === 0) {
            chipsWrap.innerHTML = '<span style="color:#b5c5b5;font-size:0.85rem;align-self:center;">Tus selecciones aparecerán aquí…</span>';
            return;
        }
        checked.forEach(cb => {
            const chip = document.createElement('span');
            chip.className = 'chip';
            chip.innerHTML = `<span>${cb.dataset.icono}</span> ${cb.dataset.nombre}`;
            chipsWrap.appendChild(chip);
        });
    }
 
    checkboxes.forEach(cb => {
        cb.addEventListener('change', actualizarUI);
    });
 
    // Estado inicial
    actualizarUI();
})();
</script>
 
@endsection