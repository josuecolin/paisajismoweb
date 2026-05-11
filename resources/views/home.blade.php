@extends('layouts.app')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Jost:wght@300;400;500&display=swap');

  :root {
    --bosque:  #1C3A12;
    --verde:   #2D5016;
    --medio:   #3D6B27;
    --hoja:    #4A7C2F;
    --claro:   #7AAD52;
    --crema:   #F5F0E8;
    --blanco:  #FDFAF5;
    --cafe:    #2D1F0A;
    --muted:   #8a9e7a;
  }

  body { background: var(--crema); font-family: 'Jost', sans-serif; }

  /* ── HERO ── */
  .home-hero {
    background: linear-gradient(160deg, var(--bosque) 0%, var(--verde) 55%, var(--medio) 100%);
    padding: 6rem 0 5rem;
    position: relative;
    overflow: hidden;
    text-align: center;
  }
  .hero-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(111,168,69,0.1);
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
  }
  .hero-dot {
    position: absolute;
    border-radius: 50%;
    background: rgba(111,168,69,0.06);
    pointer-events: none;
  }
  .hero-eyebrow {
    font-size: 0.7rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(111,168,69,0.85);
    margin-bottom: 1rem;
    display: block;
  }
  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 5vw, 3.5rem);
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 1.2rem;
  }
  .hero-title em { font-style: italic; color: #9fd876; }
  .hero-sub {
    color: rgba(255,255,255,0.65);
    font-size: 1rem;
    font-weight: 300;
    max-width: 520px;
    margin: 0 auto 2rem;
    line-height: 1.8;
  }
  .hero-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
  .btn-hero-prim {
    background: var(--hoja);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 0.85rem 2.2rem;
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 8px 24px rgba(28,58,18,0.4);
    transition: opacity 0.2s, transform 0.15s;
  }
  .btn-hero-prim:hover { opacity: 0.9; transform: translateY(-2px); color: #fff; }
  .btn-hero-sec {
    background: rgba(255,255,255,0.1);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 50px;
    padding: 0.85rem 2.2rem;
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    transition: background 0.2s;
  }
  .btn-hero-sec:hover { background: rgba(255,255,255,0.18); color: #fff; }

  /* ── STATS ── */
  .stats-bar {
    background: var(--verde);
    padding: 1.4rem 0;
  }
  .stat-item { text-align: center; padding: 0.5rem 1rem; }
  .stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #9fd876;
    display: block;
  }
  .stat-lbl {
    font-size: 0.68rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.45);
  }

  /* ── ESTILOS ── */
  .section-eyebrow {
    font-size: 0.72rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--hoja);
    font-weight: 600;
    margin-bottom: 0.4rem;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--cafe);
    font-weight: 600;
    margin-bottom: 0.4rem;
  }
  .section-sub { color: var(--muted); font-size: 0.9rem; }

  .garden-card {
    background: var(--blanco);
    border: 1px solid rgba(74,124,47,0.1);
    border-radius: 20px;
    overflow: hidden;
    height: 100%;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .garden-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(45,80,22,0.13);
  }
  .garden-img { height: 220px; object-fit: cover; width: 100%; }
  .garden-body { padding: 1.4rem; }
  .garden-icon { font-size: 1.8rem; margin-bottom: 0.5rem; }
  .garden-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    color: var(--cafe);
    font-weight: 600;
    margin-bottom: 0.4rem;
  }
  .garden-desc { font-size: 0.85rem; color: var(--muted); line-height: 1.6; margin-bottom: 1rem; }
  .btn-explorar {
    display: inline-block;
    background: rgba(74,124,47,0.1);
    color: var(--verde);
    border-radius: 20px;
    padding: 0.4rem 1.2rem;
    font-size: 0.82rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
  }
  .btn-explorar:hover { background: var(--verde); color: #fff; }

  /* ── FEATURES ── */
  .features-section { background: var(--blanco); }
  .feat-card {
    background: var(--crema);
    border: 1px solid rgba(74,124,47,0.08);
    border-radius: 18px;
    padding: 2rem 1.5rem;
    text-align: center;
    height: 100%;
    transition: transform 0.2s;
  }
  .feat-card:hover { transform: translateY(-3px); }
  .feat-icon {
    width: 56px; height: 56px;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem;
    margin: 0 auto 1rem;
  }
  .feat-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    color: var(--cafe);
    font-weight: 600;
    margin-bottom: 0.5rem;
  }
  .feat-desc { font-size: 0.83rem; color: var(--muted); line-height: 1.6; }

  /* ── TESTIMONIOS ── */
  .test-card {
    background: var(--blanco);
    border: 1px solid rgba(74,124,47,0.1);
    border-radius: 18px;
    padding: 1.6rem;
    height: 100%;
  }
  .test-stars { color: #f0b429; font-size: 0.85rem; margin-bottom: 0.7rem; }
  .test-text {
    font-size: 0.88rem;
    color: #5a6a5a;
    line-height: 1.7;
    font-style: italic;
    margin-bottom: 1rem;
  }
  .test-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: var(--medio);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    text-transform: uppercase;
  }
  .test-name { font-size: 0.82rem; font-weight: 600; color: var(--cafe); }
  .test-role { font-size: 0.72rem; color: var(--muted); }

  /* ── CTA ── */
  .cta-section {
    background: linear-gradient(135deg, var(--bosque), var(--verde));
    text-align: center;
    padding: 5rem 0;
  }
  .cta-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    color: #fff;
    font-weight: 700;
    margin-bottom: 0.8rem;
  }
  .cta-title em { font-style: italic; color: #9fd876; }
  .cta-sub { color: rgba(255,255,255,0.6); font-size: 0.95rem; margin-bottom: 2rem; }
</style>

{{-- ── HERO ── --}}
<section class="home-hero">
  <div class="hero-ring" style="width:650px;height:650px;"></div>
  <div class="hero-ring" style="width:440px;height:440px;"></div>
  <div class="hero-ring" style="width:260px;height:260px;"></div>
  <div class="hero-dot" style="width:200px;height:200px;top:-60px;right:-40px;"></div>
  <div class="hero-dot" style="width:120px;height:120px;bottom:-20px;left:3%;"></div>

  <div class="container" style="position:relative;z-index:2;">
    <span class="hero-eyebrow">Paisajismo inteligente · Valle</span>
    <h1 class="hero-title">
      Transforma tu espacio en<br>un <em>jardín de ensueño</em>
    </h1>
    <p class="hero-sub">
      Diseña, explora y comparte proyectos de paisajismo con una comunidad
      apasionada por los espacios verdes y la naturaleza.
    </p>
    <div class="hero-btns">
      <a href="{{ route('renovar') }}" class="btn-hero-prim">🌿 Renueva mi jardín</a>
      <a href="{{ route('posts.explorar') }}" class="btn-hero-sec">Explorar proyectos</a>
    </div>
  </div>
</section>

{{-- ── STATS ── --}}
<div class="stats-bar">
  <div class="container">
    <div class="row justify-content-center g-2">
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <span class="stat-num">100+</span>
          <span class="stat-lbl">Proyectos publicados</span>
        </div>
      </div>
      
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <span class="stat-num">18</span>
          <span class="stat-lbl">Categorías</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-item">
          <span class="stat-num">4.5 ★</span>
          <span class="stat-lbl">Valoración</span>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ── ESTILOS DE JARDÍN ── --}}
<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <p class="section-eyebrow">Inspiración</p>
      <h2 class="section-title">Estilos de jardín populares</h2>
      <p class="section-sub">Encuentra tu estilo y comienza a diseñar</p>
    </div>
    <div class="row g-4">

      <div class="col-md-4">
        <div class="garden-card">
          <img src="https://images.unsplash.com/photo-1598908314732-07113901949e?w=600&q=80"
               class="garden-img" alt="Jardín moderno">
          <div class="garden-body">
            <div class="garden-icon">🏡</div>
            <h3 class="garden-title">Jardín Moderno</h3>
            <p class="garden-desc">Diseños minimalistas con vegetación elegante y líneas arquitectónicas limpias.</p>
            <a href="{{ route('posts.explorar') }}" class="btn-explorar">Explorar →</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="garden-card">
          <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=600&q=80"
               class="garden-img" alt="Jardín tropical">
          <div class="garden-body">
            <div class="garden-icon">🌴</div>
            <h3 class="garden-title">Jardín Tropical</h3>
            <p class="garden-desc">Plantas exuberantes que generan un ambiente fresco, relajante y lleno de vida.</p>
            <a href="{{ route('posts.explorar') }}" class="btn-explorar">Explorar →</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="garden-card">
          <img src="https://images.unsplash.com/photo-1598899134739-24c46f58c1a3?w=600&q=80"
               class="garden-img" alt="Jardín zen">
          <div class="garden-body">
            <div class="garden-icon">🌿</div>
            <h3 class="garden-title">Jardín Zen</h3>
            <p class="garden-desc">Equilibrio y serenidad con elementos naturales que invitan a la contemplación.</p>
            <a href="{{ route('posts.explorar') }}" class="btn-explorar">Explorar →</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── FEATURES ── --}}
<section class="features-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <p class="section-eyebrow">¿Por qué elegirnos?</p>
      <h2 class="section-title">Todo lo que necesitas</h2>
      <p class="section-sub">Herramientas pensadas para paisajistas y entusiastas del jardín</p>
    </div>
    <div class="row g-4">

      <div class="col-6 col-md-3">
        <div class="feat-card">
          <div class="feat-icon" style="background:rgba(74,124,47,0.12);">🤖</div>
          <h4 class="feat-title">IA para tu jardín</h4>
          <p class="feat-desc">Genera diseños y recomendaciones personalizadas con inteligencia artificial.</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="feat-card">
          <div class="feat-icon" style="background:rgba(240,180,41,0.12);">📋</div>
          <h4 class="feat-title">explorar</h4>
          <p class="feat-desc">explora diferentes proyectos de paisajismo e inspirate en ellos.</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="feat-card">
          <div class="feat-icon" style="background:rgba(29,158,117,0.12);">🌐</div>
          <h4 class="feat-title">Comunidad</h4>
          <p class="feat-desc">Comparte tu trabajo y descubre los proyectos de otros paisajistas.</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="feat-card">
          <div class="feat-icon" style="background:rgba(111,168,69,0.12);">🔖</div>
          <h4 class="feat-title">Guarda favoritos</h4>
          <p class="feat-desc">Colecciona los proyectos que más te inspiren para volver después.</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── TESTIMONIOS ── --}}
<section class="py-5" style="background:var(--crema);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="section-eyebrow">Comunidad</p>
      <h2 class="section-title">Lo que dicen nuestros usuarios</h2>
    </div>
    <div class="row g-4">

      <div class="col-md-4">
        <div class="test-card">
          <div class="test-stars">★★★★★</div>
          <p class="test-text">"Transformé mi patio completamente gracias a las recomendaciones de la IA. Una herramienta increíble."</p>
          <div class="d-flex align-items-center gap-2">
            <div class="test-avatar">JS</div>
            <div>
              <p class="test-name mb-0">Josue Colin</p>
              <p class="test-role mb-0">Diseñador de interiores</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="test-card">
          <div class="test-stars">★★★★★</div>
          <p class="test-text">"La comunidad es muy activa. Los proyectos compartidos son una fuente inagotable de inspiración."</p>
          <div class="d-flex align-items-center gap-2">
            <div class="test-avatar">DP</div>
            <div>
              <p class="test-name mb-0">Didier pineda</p>
              <p class="test-role mb-0">Arquitecto paisajista</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="test-card">
          <div class="test-stars">★★★★☆</div>
          <p class="test-text">"las publicaciones me ayudaron a inspirarme para realizar mi proyecto de jardín de principio a fin. Muy recomendable."</p>
          <div class="d-flex align-items-center gap-2">
            <div class="test-avatar">PP</div>
            <div>
              <p class="test-name mb-0">pedro parker</p>
              <p class="test-role mb-0">Entusiasta del jardín</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── CTA FINAL ── --}}
<section class="cta-section">
  <div class="container">
    <h2 class="cta-title">¿Listo para <em>transformar</em> tu espacio?</h2>
    <p class="cta-sub">Únete a la comunidad y empieza a diseñar hoy mismo — es gratis</p>
    <div class="hero-btns">
      @guest
        <a href="{{ route('register') }}" class="btn-hero-prim">🌱 Crear mi cuenta gratis</a>
        <a href="{{ route('posts.explorar') }}" class="btn-hero-sec">Ver proyectos primero</a>
      @else
        <a href="{{ route('renovar') }}" class="btn-hero-prim">🌿 Renueva mi jardín</a>
        <a href="{{ route('posts.explorar') }}" class="btn-hero-sec">Explorar comunidad</a>
      @endguest
    </div>
  </div>
</section>

@endsection