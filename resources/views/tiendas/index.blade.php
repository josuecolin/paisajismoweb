{{-- resources/views/tiendas/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tiendas Recomendadas')

@section('content')

{{-- ✅ CSS inline dentro del content para evitar depender de @stack('styles') --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
    --g1: #0d2b1a; --g2: #1a4731; --g3: #2d6a4f; --g4: #52b788;
    --g5: #95d5b2; --g6: #d8f3dc; --sand: #f7f2ea; --sand2: #ede8df;
    --ink: #111c14; --ink2: #3a4e3d; --ink3: #6b7f6e; --borde: #d0e8d4;
    --white: #ffffff; --radius: 18px; --radius-sm: 10px;
    --shadow: 0 4px 24px rgba(13,43,26,.10);
    --shadow-lg: 0 16px 48px rgba(13,43,26,.18);
}

/* Reset Bootstrap conflicts dentro de la página */
.tiendas-page *, .tiendas-page *::before, .tiendas-page *::after {
    box-sizing: border-box;
}

.tiendas-page {
    font-family: 'DM Sans', sans-serif !important;
    background: var(--sand) !important;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* ── Neutralizar .card de Bootstrap ── */
.tiendas-page .t-card {
    border: 1px solid var(--borde) !important;
    border-radius: var(--radius) !important;
    box-shadow: none !important;
    background: #fff !important;
}

/* Hero */
.t-hero {
    position: relative;
    background: var(--g1) !important;
    padding: 4rem 2rem 6rem;
    text-align: center;
    overflow: hidden;
}
.t-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 15% 110%, rgba(82,183,136,.22) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 85% -10%, rgba(45,106,79,.35) 0%, transparent 55%);
    pointer-events: none;
}
.t-hero-leaf {
    position: absolute; font-size: 9rem; opacity: .04;
    pointer-events: none; line-height: 1;
}
.t-hero-leaf:first-child { top: -1rem; left: -2rem; transform: rotate(-20deg); }
.t-hero-leaf:last-child  { bottom: -2rem; right: -1rem; transform: rotate(30deg); font-size: 12rem; }

.t-eyebrow {
    position: relative; display: inline-flex; align-items: center; gap: .5rem;
    font-size: .72rem; font-weight: 600; letter-spacing: .14em; text-transform: uppercase;
    color: var(--g4); background: rgba(82,183,136,.12); border: 1px solid rgba(82,183,136,.25);
    padding: .35rem 1rem; border-radius: 30px; margin-bottom: 1.25rem;
}
.t-hero h1 {
    position: relative;
    font-family: 'Playfair Display', serif !important;
    font-size: clamp(2rem, 5vw, 3.5rem) !important;
    font-weight: 700 !important;
    color: #fff !important;
    line-height: 1.15; margin-bottom: .75rem; letter-spacing: -.02em;
}
.t-hero h1 em { font-style: normal; color: var(--g4); }
.t-hero-sub {
    position: relative;
    color: rgba(255,255,255,.55) !important;
    font-size: 1rem; font-weight: 300;
    margin-bottom: 0;
}

/* Filtro */
.t-filtro-wrap {
    max-width: 700px; margin: -2.2rem auto 3rem;
    padding: 0 1.5rem; position: relative; z-index: 10;
}
.t-filtro-card {
    background: #fff !important;
    border-radius: var(--radius) !important;
    box-shadow: var(--shadow-lg) !important;
    padding: 1.4rem 1.75rem !important;
    display: flex !important; gap: 1rem; align-items: flex-end;
    flex-wrap: wrap; border: 1px solid var(--borde) !important;
}
.t-filtro-label {
    font-size: .7rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: .1em; color: var(--ink3); display: block; margin-bottom: .45rem;
}
.t-filtro-select { flex: 1; min-width: 220px; }
.t-filtro-select select {
    width: 100%; appearance: none; -webkit-appearance: none;
    background: var(--sand) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7f6e' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") no-repeat right 1rem center !important;
    border: 1.5px solid var(--borde) !important; border-radius: var(--radius-sm) !important;
    padding: .7rem 2.5rem .7rem 1rem !important; font-size: .95rem;
    font-family: 'DM Sans', sans-serif; color: var(--ink);
    cursor: pointer; transition: border-color .2s, box-shadow .2s;
    box-shadow: none !important;
}
.t-filtro-select select:focus {
    outline: none !important;
    border-color: var(--g4) !important;
    box-shadow: 0 0 0 3px rgba(82,183,136,.15) !important;
}
.t-btn-filtro {
    background: var(--g2) !important; color: #fff !important;
    border: none !important; border-radius: var(--radius-sm) !important;
    padding: .72rem 1.6rem !important; font-size: .9rem; font-weight: 600;
    font-family: 'DM Sans', sans-serif; cursor: pointer;
    transition: background .2s, transform .1s; white-space: nowrap;
    box-shadow: 0 4px 12px rgba(26,71,49,.25) !important;
}
.t-btn-filtro:hover { background: var(--g3) !important; color: #fff !important; }
.t-btn-filtro:active { transform: scale(.97); }

/* Body */
.t-body { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem 5rem; }

/* Banner categoría */
.t-cat-banner {
    display: flex; align-items: center; gap: 1.25rem;
    padding: 1.5rem 2rem; background: #fff !important;
    border-radius: var(--radius) !important; border: 1px solid var(--borde) !important;
    margin-bottom: 2rem; box-shadow: var(--shadow) !important;
    animation: tFadeUp .4s ease both;
}
.t-cat-emoji {
    width: 56px; height: 56px; background: var(--g6); border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.9rem; flex-shrink: 0; border: 1px solid var(--borde);
}
.t-cat-banner-text h2 {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.35rem !important; font-weight: 700 !important;
    color: var(--ink) !important; margin-bottom: .2rem !important;
}
.t-cat-banner-text p { font-size: .87rem; color: var(--ink3); line-height: 1.5; margin: 0; }
.t-cat-count {
    margin-left: auto; font-size: .75rem; font-weight: 600;
    color: var(--g3); background: var(--g6); border: 1px solid var(--borde);
    padding: .3rem .85rem; border-radius: 30px; white-space: nowrap; flex-shrink: 0;
}

/* Grid */
.t-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
    gap: 1.4rem;
}

/* Tarjeta */
.t-card {
    background: #fff !important;
    border-radius: var(--radius) !important;
    border: 1px solid var(--borde) !important;
    overflow: hidden; display: flex !important; flex-direction: column !important;
    cursor: pointer; box-shadow: none !important;
    transition: transform .25s cubic-bezier(.34,1.56,.64,1), box-shadow .25s;
    animation: tFadeUp .5s ease both;
}
.t-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: var(--shadow-lg) !important;
}
.t-card:nth-child(1){animation-delay:.05s} .t-card:nth-child(2){animation-delay:.10s}
.t-card:nth-child(3){animation-delay:.15s} .t-card:nth-child(4){animation-delay:.20s}
.t-card:nth-child(5){animation-delay:.25s} .t-card:nth-child(6){animation-delay:.30s}

.t-card-stripe { height: 7px; width: 100%; display: block; }
.t-card-body {
    padding: 1.4rem 1.5rem 1rem; flex: 1;
    display: flex !important; flex-direction: column !important;
}
.t-card-head { display: flex; align-items: flex-start; gap: .9rem; margin-bottom: 1rem; }
.t-card-emoji {
    width: 48px; height: 48px; background: var(--sand); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; flex-shrink: 0; border: 1px solid var(--sand2);
    transition: transform .2s;
}
.t-card:hover .t-card-emoji { transform: scale(1.1) rotate(-5deg); }
.t-card-meta h3 {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.05rem !important; font-weight: 700 !important;
    color: var(--ink) !important; line-height: 1.3; margin-bottom: .3rem !important;
}
.t-card-tipo {
    font-size: .68rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: .07em; color: var(--g3); background: var(--g6);
    padding: .18rem .6rem; border-radius: 20px; display: inline-block;
    border: 1px solid var(--borde);
}
.t-card-desc {
    font-size: .86rem; color: var(--ink3); line-height: 1.65;
    margin-bottom: 1rem; flex: 1;
    display: -webkit-box; -webkit-line-clamp: 3;
    -webkit-box-orient: vertical; overflow: hidden;
}
.t-card-tags { display: flex; flex-wrap: wrap; gap: .35rem; margin-bottom: 1rem; }
.t-tag {
    font-size: .68rem; font-weight: 500; padding: .2rem .6rem;
    background: var(--sand); border: 1px solid var(--sand2);
    border-radius: 20px; color: var(--ink2);
}
.t-card-footer {
    padding: 1rem 1.5rem; border-top: 1px solid var(--sand2) !important;
    display: flex !important; align-items: center; justify-content: space-between;
    background: transparent !important;
}
.t-ver-mas {
    display: inline-flex; align-items: center; gap: .4rem;
    font-size: .82rem; font-weight: 600; color: var(--g2);
    text-decoration: none;
}
.t-ver-mas svg { width: 14px; height: 14px; stroke: currentColor; transition: transform .2s; }
.t-card:hover .t-ver-mas svg { transform: translateX(4px); }
.t-web-badge { font-size: .7rem; color: var(--ink3); display: flex; align-items: center; gap: .3rem; }
.t-web-badge svg { width: 12px; height: 12px; stroke: currentColor; }

/* Modal */
.t-modal-overlay {
    position: fixed; inset: 0; background: rgba(13,43,26,.6);
    backdrop-filter: blur(5px); z-index: 9999;
    display: flex; align-items: center; justify-content: center; padding: 1.5rem;
    opacity: 0; visibility: hidden; transition: opacity .3s, visibility .3s;
}
.t-modal-overlay.open { opacity: 1 !important; visibility: visible !important; }
.t-modal {
    background: #fff !important; border-radius: 24px !important;
    max-width: 540px; width: 100%;
    box-shadow: 0 32px 80px rgba(0,0,0,.3) !important;
    overflow: hidden; border: none !important;
    transform: translateY(20px) scale(.97);
    transition: transform .35s cubic-bezier(.34,1.36,.64,1);
}
.t-modal-overlay.open .t-modal { transform: translateY(0) scale(1); }
.t-modal-hd {
    background: linear-gradient(135deg, var(--g1), var(--g2)) !important;
    padding: 2rem; position: relative;
}
.t-modal-close {
    position: absolute; top: 1rem; right: 1rem;
    width: 32px; height: 32px;
    background: rgba(255,255,255,.12) !important;
    border: 1px solid rgba(255,255,255,.2) !important;
    border-radius: 50% !important; color: #fff !important;
    cursor: pointer; font-size: 1rem;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s; box-shadow: none !important;
}
.t-modal-close:hover { background: rgba(255,255,255,.22) !important; }
.t-modal-hd-inner { display: flex; align-items: center; gap: 1rem; }
.t-modal-emoji {
    width: 58px; height: 58px; background: rgba(255,255,255,.12);
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    font-size: 2rem; border: 1px solid rgba(255,255,255,.15); flex-shrink: 0;
}
.t-modal-hd h2 {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.45rem !important; font-weight: 700 !important;
    color: #fff !important; margin-bottom: .3rem !important;
}
.t-modal-tipo {
    font-size: .7rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: .08em; color: var(--g5);
    background: rgba(82,183,136,.15); padding: .2rem .65rem;
    border-radius: 20px; border: 1px solid rgba(82,183,136,.25); display: inline-block;
}
.t-modal-bd { padding: 1.75rem 2rem 2rem; }
.t-modal-desc {
    font-size: .95rem; color: var(--ink2); line-height: 1.7;
    margin-bottom: 1.4rem; padding-bottom: 1.4rem;
    border-bottom: 1px solid var(--sand2);
}
.t-modal-slabel {
    font-size: .67rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .1em; color: var(--ink3); margin-bottom: .6rem; display: block;
}
.t-modal-tags { display: flex; flex-wrap: wrap; gap: .4rem; margin-bottom: 1.5rem; }
.t-modal-tag {
    font-size: .8rem; font-weight: 500; padding: .3rem .85rem;
    background: var(--g6); border: 1px solid var(--borde);
    border-radius: 20px; color: var(--g2);
}
.t-btn-sitio {
    display: flex !important; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; padding: .9rem; background: var(--g2) !important;
    color: #fff !important; border-radius: var(--radius-sm) !important;
    font-size: .95rem; font-weight: 600; text-decoration: none !important;
    transition: background .2s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(26,71,49,.25) !important;
    font-family: 'DM Sans', sans-serif; border: none !important;
}
.t-btn-sitio:hover { background: var(--g3) !important; color: #fff !important; }
.t-btn-sitio svg { width: 16px; height: 16px; stroke: currentColor; }

/* Vacío */
.t-vacio { text-align: center; padding: 4rem 2rem; color: var(--ink3); }
.t-vacio .t-icon { font-size: 4rem; display: block; margin-bottom: 1rem; opacity: .5; }
.t-vacio h3 {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.25rem !important; font-weight: 700 !important;
    color: var(--ink) !important; margin-bottom: .4rem !important;
}
.t-vacio p { font-size: .9rem; }

@keyframes tFadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 600px) {
    .t-filtro-card { flex-direction: column !important; }
    .t-btn-filtro { width: 100% !important; }
    .t-grid { grid-template-columns: 1fr !important; }
    .t-modal-bd { padding: 1.25rem !important; }
    .t-modal-hd { padding: 1.5rem 1.25rem !important; }
    .t-cat-count { display: none !important; }
}
</style>

<div class="tiendas-page">

{{-- Hero --}}
<section class="t-hero">
    <span class="t-hero-leaf">🌿</span>
    <span class="t-hero-leaf">🌱</span>
    <div class="t-eyebrow"><span>🌿</span> Paisajismo Inteligente</div>
    <h1>Tiendas <em>Recomendadas</em></h1>
    <p class="t-hero-sub">Los mejores proveedores según el tipo de jardín que diseñas</p>
</section>

{{-- Filtro flotante --}}
<div class="t-filtro-wrap">
    <form class="t-filtro-card" method="GET" action="{{ route('tiendas.index') }}">
        <div class="t-filtro-select">
            <span class="t-filtro-label">Categoría de jardín</span>
            <select name="categoria" id="categoria" onchange="this.form.submit()">
                <option value="">— Selecciona una categoría —</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->slug }}"
                        {{ request('categoria') === $cat->slug ? 'selected' : '' }}>
                        {{ $cat->icono ?? '' }} {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="t-btn-filtro">🔍 Buscar</button>
    </form>
</div>

{{-- Cuerpo --}}
<div class="t-body">

    @if ($categoriaSeleccionada)

        <div class="t-cat-banner">
            <div class="t-cat-emoji">{{ $categoriaSeleccionada->icono ?? '🌱' }}</div>
            <div class="t-cat-banner-text">
                <h2>{{ $categoriaSeleccionada->nombre }}</h2>
                <p>{{ $categoriaSeleccionada->descripcion }}</p>
            </div>
            <span class="t-cat-count">
                {{ $tiendas->count() }} {{ $tiendas->count() === 1 ? 'tienda' : 'tiendas' }}
            </span>
        </div>

        @if ($tiendas->isNotEmpty())
            <div class="t-grid">
                @foreach ($tiendas as $tienda)

                {{-- Tarjeta --}}
                <article class="t-card" onclick="tAbrirModal({{ $tienda->id }})">
                    <div class="t-card-stripe" style="background: linear-gradient(90deg, {{ $tienda->color ?? '#2d6a4f' }}, {{ $tienda->color ?? '#52b788' }}88);"></div>
                    <div class="t-card-body">
                        <div class="t-card-head">
                            <div class="t-card-emoji">{{ $tienda->icono }}</div>
                            <div class="t-card-meta">
                                <h3>{{ $tienda->nombre }}</h3>
                                <span class="t-card-tipo">{{ $tienda->tipo }}</span>
                            </div>
                        </div>
                        <p class="t-card-desc">{{ $tienda->descripcion }}</p>
                        <div class="t-card-tags">
                            @foreach ($tienda->tags as $tag)
                                <span class="t-tag">{{ $tag->tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="t-card-footer">
                        <span class="t-ver-mas">
                            Ver información
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </span>
                        @if($tienda->sitio_web)
                        <span class="t-web-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                            Sitio web
                        </span>
                        @endif
                    </div>
                </article>

                {{-- Modal --}}
                <div class="t-modal-overlay" id="tmodal-{{ $tienda->id }}" onclick="tCerrarOverlay(event, {{ $tienda->id }})">
                    <div class="t-modal">
                        <div class="t-modal-hd">
                            <button class="t-modal-close" onclick="tCerrarModal({{ $tienda->id }})">✕</button>
                            <div class="t-modal-hd-inner">
                                <div class="t-modal-emoji">{{ $tienda->icono }}</div>
                                <div>
                                    <h2>{{ $tienda->nombre }}</h2>
                                    <span class="t-modal-tipo">{{ $tienda->tipo }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="t-modal-bd">
                            <p class="t-modal-desc">{{ $tienda->descripcion }}</p>
                            @if($tienda->tags->isNotEmpty())
                                <span class="t-modal-slabel">Especialidades</span>
                                <div class="t-modal-tags">
                                    @foreach($tienda->tags as $tag)
                                        <span class="t-modal-tag">{{ $tag->tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($tienda->sitio_web)
                            <a href="{{ $tienda->sitio_web }}" target="_blank" rel="noopener" class="t-btn-sitio">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                    <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                                </svg>
                                Visitar tienda
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                @endforeach
            </div>

        @else
            <div class="t-vacio">
                <span class="t-icon">🔧</span>
                <h3>Sin tiendas en esta categoría aún</h3>
                <p>Puedes agregar proveedores desde el panel de administración.</p>
            </div>
        @endif

    @else
        <div class="t-vacio">
            <span class="t-icon">🏪</span>
            <h3>Elige una categoría para comenzar</h3>
            <p>Te mostraremos los mejores proveedores de plantas, materiales y accesorios para ese tipo de jardín.</p>
        </div>
    @endif

</div>{{-- /.t-body --}}
</div>{{-- /.tiendas-page --}}

<script>
function tAbrirModal(id) {
    document.getElementById('tmodal-' + id).classList.add('open');
    document.body.style.overflow = 'hidden';
}
function tCerrarModal(id) {
    document.getElementById('tmodal-' + id).classList.remove('open');
    document.body.style.overflow = '';
}
function tCerrarOverlay(e, id) {
    if (e.target === e.currentTarget) tCerrarModal(id);
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.t-modal-overlay.open').forEach(function(el) {
            el.classList.remove('open');
            document.body.style.overflow = '';
        });
    }
});
</script>
@endsection