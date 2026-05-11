<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paisajismo Inteligente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            background: #f0f4ec;
            font-family: 'Jost', sans-serif;
            margin: 0;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 240px;
            height: 100vh;
            background: #1C3A12;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-top {
            padding: 20px 16px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: rgba(111,168,69,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: #fff;
            font-weight: 600;
            line-height: 1.2;
        }

        .sidebar-brand-sub {
            font-size: 0.62rem;
            color: #6FA845;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Usuario pill */
        .sidebar-user {
            margin: 12px 12px 4px;
            background: rgba(255,255,255,0.06);
            border-radius: 10px;
            padding: 8px 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: #3D6B27;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #a0d070;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .sidebar-uname {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 6px 10px;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }

        .nav-section {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(111,168,69,0.45);
            padding: 14px 8px 5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 9px;
            color: rgba(255,255,255,0.55);
            font-size: 0.84rem;
            text-decoration: none;
            margin-bottom: 2px;
            transition: background 0.15s, color 0.15s;
        }

        .nav-item:hover {
            background: rgba(111,168,69,0.14);
            color: #c8e6a0;
            text-decoration: none;
        }

        .nav-item.active {
            background: rgba(111,168,69,0.18);
            color: #c8e6a0;
            font-weight: 500;
        }

        .nav-item.active i { color: #6FA845; }
        .nav-item i { font-size: 17px; flex-shrink: 0; }

        /* Logout */
        .sidebar-bottom {
            padding: 10px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .nav-item-logout {
            color: rgba(255,100,100,0.6) !important;
        }

        .nav-item-logout:hover {
            background: rgba(255,80,80,0.08) !important;
            color: #ff9090 !important;
        }

        /* ── NAVBAR GUEST (sin sidebar) ── */
        .navbar-guest {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        /* ── MAIN LAYOUT ── */
        @auth
        body { display: flex; }
        .main-content {
            margin-left: 240px;
            flex: 1;
            min-height: 100vh;
        }
        @endauth

        /* ── TOGGLE MOBILE ── */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 12px; left: 12px;
            z-index: 200;
            background: #1C3A12;
            color: #6FA845;
            border: none;
            border-radius: 8px;
            width: 38px; height: 38px;
            align-items: center; justify-content: center;
            font-size: 18px;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 99;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.open { display: block; }
            .sidebar-toggle { display: flex; }
            .main-content { margin-left: 0 !important; }
        }

        /* ── CARD ── */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        .btn-main {
            background: #3D6B27;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
        }

        .btn-main:hover { background: #2e5018; color: white; }
    </style>
</head>
<body>

@auth
{{-- ── SIDEBAR (solo usuarios autenticados) ── --}}
<button class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir menú">
    <i class="ti ti-menu-2"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-top">
        <a class="sidebar-brand" href="{{ route('home') }}">
            <div class="sidebar-brand-icon">🌿</div>
            <div>
                <div class="sidebar-brand-name">Paisajismo</div>
                <div class="sidebar-brand-sub">Valle</div>
            </div>
        </a>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
        <span class="sidebar-uname">{{ Auth::user()->name }}</span>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section">General</div>

        <a href="{{ route('home') }}"
           class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="ti ti-home" aria-hidden="true"></i>
            Inicio
        </a>

        <a href="{{ route('posts.explorar') }}"
           class="nav-item {{ request()->routeIs('posts.explorar') ? 'active' : '' }}">
            <i class="ti ti-compass" aria-hidden="true"></i>
            Explorar
        </a>

        <div class="nav-section">Mis cosas</div>

        <a href="{{ route('posts.index') }}"
           class="nav-item {{ request()->routeIs('posts.index') ? 'active' : '' }}">
            <i class="ti ti-article" aria-hidden="true"></i>
            Mis publicaciones
        </a>


        <a href="{{ route('proyectos-guardados') }}"
        class="nav-item {{ request()->routeIs('proyectos-guardados') ? 'active' : '' }}">
            <i class="ti ti-bookmark" aria-hidden="true"></i>
            Proyectos guardados
        </a>

        <a href="{{ route('tiendas.index') }}"
           class="nav-item {{ request()->routeIs('tiendas.index') ? 'active' : '' }}">
            <i class="ti ti-notebook" aria-hidden="true"></i>
            tiendas de articulos 
        </a>

        <div class="nav-section">Personalizar</div>

        <a href="{{ route('dashboard') }}"
           class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="ti ti-layout-dashboard" aria-hidden="true"></i>
            mi perfil
        </a>

        <a href="{{ route('categorias.preferencias') }}"
           class="nav-item {{ request()->routeIs('categorias.preferencias') ? 'active' : '' }}">
            <i class="ti ti-adjustments-horizontal" aria-hidden="true"></i>
            Preferencias
        </a>

        <a href="{{ route('renovar') }}"
           class="nav-item {{ request()->routeIs('renovar') ? 'active' : '' }}">
            <i class="ti ti-plant-2" aria-hidden="true"></i>
            Renovar jardín
        </a>

    </nav>

    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item nav-item-logout w-100 border-0 bg-transparent text-start">
                <i class="ti ti-logout" aria-hidden="true"></i>
                Cerrar sesión
            </button>
        </form>
    </div>

</aside>

<div class="main-content">
    @yield('content')
</div>

@else
{{-- ── NAVBAR GUEST ── --}}
<nav class="navbar navbar-expand-lg navbar-guest">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ url('/') }}">
            🌿 Paisajismo_valle
        </a>
        <a class="navbar-brand fw-bold text-success" href="{{ route('posts.explorar') }}">
            Explorar
        </a>
        <div class="d-flex align-items-center ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-dark me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-main">Registrarse</a>
        </div>
    </div>
</nav>

@yield('content')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggle) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });
    }
</script>
</body>
</html>