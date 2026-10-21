@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero-dashboard d-flex align-items-center">
    <div class="container">

        <div class="row align-items-center">

            <!-- TEXTO -->
            <div class="col-lg-7 text-white">
                <span class="badge bg-success px-3 py-2 mb-3">
                    🌿 Plataforma de Paisajismo
                </span>

                <h1 class="display-4 fw-bold">
                    Bienvenido, {{ Auth::user()->name }}
                </h1>

                <p class="lead mt-3">
                    Administra tus proyectos de jardines, visualiza tus diseños
                    y crea espacios naturales únicos.
                </p>

                <div class="mt-4">
                    <a href="/renovar-jardin" class="btn btn-success btn-lg me-2">
                        Crear proyecto con IA
                    </a>

                    <a href="/posts" class="btn btn-outline-light btn-lg">
                        Ver proyectos
                    </a>
                </div>
            </div>

            <!-- PERFIL -->
            <div class="col-lg-5 mt-5 mt-lg-0">

                <div class="profile-card shadow-lg">

                    <div class="text-center">

                        <div class="profile-avatar">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>

                        <h3 class="fw-bold mt-3">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    <hr>

                    <div class="row text-center">

                        <div class="col-4">
                            <h4 class="fw-bold text-success">12</h4>
                            <small>crear proyecto con IA</small>
                        </div>

                        <div class="col-4">
                            <h4 class="fw-bold text-success">5</h4>
                            <small>Guardados</small>
                        </div>

                        <div class="col-4">
                            <h4 class="fw-bold text-success">3</h4>
                            <small>Favoritos</small>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- ESTADO DEL CUESTIONARIO -->
<section class="questionnaire-status-section">
    <div class="container py-4">

        @if(Auth::user()->questionnaire_completed_at)

            <!-- CUESTIONARIO COMPLETADO -->
            <div class="questionnaire-status-card questionnaire-completed">

                <div class="questionnaire-status-icon">
                    <i class="ti ti-circle-check"></i>
                </div>

                <div class="questionnaire-status-content">

                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="status-badge completed-badge">
                            Completado
                        </span>

                        <small class="text-muted">
                            Perfil personalizado
                        </small>
                    </div>

                    <h4 class="fw-bold mb-2">
                        ¡Tu cuestionario de preferencias está completo!
                    </h4>

                    <p class="mb-0 text-muted">
                        Tus respuestas están guardadas y nos ayudan a
                        personalizar los proyectos y recomendaciones de
                        paisajismo que aparecen en tu cuenta.
                    </p>

                </div>


                <div class="questionnaire-status-action">

                    <a
                        href="{{ route('questionnaire.create') }}"
                        class="btn btn-outline-success"
                    >
                        <i class="ti ti-edit me-1"></i>
                        Modificar respuestas
                    </a>

                </div>

            </div>

        @else

            <!-- CUESTIONARIO PENDIENTE -->
            <div class="questionnaire-status-card questionnaire-pending">

                <div class="questionnaire-status-icon pending-icon">
                    <i class="ti ti-clipboard-text"></i>
                </div>

                <div class="questionnaire-status-content">

                    <div class="d-flex align-items-center gap-2 mb-1">

                        <span class="status-badge pending-badge">
                            Pendiente
                        </span>

                        <small class="text-muted">
                            Recomendado
                        </small>

                    </div>

                    <h4 class="fw-bold mb-2">
                        Completa tu cuestionario de preferencias
                    </h4>

                    <p class="mb-0 text-muted">
                        Aún no conocemos tus gustos de paisajismo.
                        Responde el cuestionario para recibir proyectos,
                        estilos y recomendaciones adaptadas a tus
                        preferencias.
                    </p>

                </div>


                <div class="questionnaire-status-action">

                    <a
                        href="{{ route('questionnaire.create') }}"
                        class="btn btn-success"
                    >
                        <i class="ti ti-leaf me-1"></i>
                        Responder cuestionario
                    </a>

                </div>

            </div>

        @endif

    </div>
</section>

<!-- OPCIONES -->
<div class="container py-5">

    <div class="row g-4">

        <!-- NUEVO PROYECTO -->
        <div class="col-md-4">

            <div class="dashboard-card card-1 shadow">

                <div class="overlay"></div>

                <div class="content text-white">

                    <div class="icon-box">
                        🌱
                    </div>

                    <h3 class="fw-bold mt-3">
                        Nuevo Proyecto con IA
                    </h3>

                    <p>
                        Diseña jardines modernos con recomendaciones inteligentes.
                    </p>

                    <a href="/renovar-jardin" class="btn btn-success">
                        Crear diseño
                    </a>

                </div>

            </div>

        </div>


        <!-- MIS PROYECTOS -->
        <div class="col-md-4">

            <div class="dashboard-card card-2 shadow">

                <div class="overlay"></div>

                <div class="content text-white">

                    <div class="icon-box">
                        🌳
                    </div>

                    <h3 class="fw-bold mt-3">
                        Mis Proyectos
                    </h3>

                    <p>
                        Consulta, edita y administra todos tus jardines.
                    </p>

                    <a href="/posts" class="btn btn-success">
                        Ver proyectos
                    </a>

                </div>

            </div>

        </div>


        <!-- GUARDADOS -->
        <div class="col-md-4">

            <div class="dashboard-card card-3 shadow">

                <div class="overlay"></div>

                <div class="content text-white">

                    <div class="icon-box">
                        🌸
                    </div>

                    <h3 class="fw-bold mt-3">
                        Guardados
                    </h3>

                    <p>
                        Accede rápidamente a tus diseños favoritos.
                    </p>

                    <a href="/proyectos-guardados" class="btn btn-success">
                        Ver guardados
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>



<style>

/* BODY */
body{
    background:#f5f7f2;
    font-family:'Segoe UI', sans-serif;
}

/* HERO */
.hero-dashboard{
    min-height: 500px;
    background-image:
    linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('https://images.unsplash.com/photo-1506744038136-46273834b3fb');
    background-size:cover;
    background-position:center;
    padding:80px 0;
}

/* PERFIL */
.profile-card{
    background:#fff;
    border-radius:25px;
    padding:35px;
}

.profile-avatar{
    width:100px;
    height:100px;
    background:linear-gradient(135deg,#4caf50,#81c784);
    color:#fff;
    font-size:40px;
    font-weight:bold;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* CARDS */
.dashboard-card{
    height:320px;
    border-radius:25px;
    overflow:hidden;
    position:relative;
    background-size:cover;
    background-position:center;
    transition:all .4s ease;
}

.dashboard-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

/* FONDOS */
.card-1{
    background-image:url('https://images.unsplash.com/photo-1466692476868-aef1dfb1e735');
}

.card-2{
    background-image:url('https://images.unsplash.com/photo-1494526585095-c41746248156');
}

.card-3{
    background-image:url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6');
}

/* OVERLAY */
.overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.55);
}

/* CONTENT */
.content{
    position:relative;
    z-index:2;
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:30px;
}

.icon-box{
    width:70px;
    height:70px;
    border-radius:20px;
    background:rgba(255,255,255,0.2);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:35px;
    backdrop-filter: blur(5px);
}

/* BOTONES */
.btn-success{
    background:#43a047;
    border:none;
    border-radius:12px;
    padding:10px 20px;
}

.btn-success:hover{
    background:#2e7d32;
}

.btn-outline-light{
    border-radius:12px;
    padding:10px 20px;
}

/* =====================================================
   ESTADO DEL CUESTIONARIO
===================================================== */

.questionnaire-status-section{
    background:#f5f7f2;
}

.questionnaire-status-card{
    background:#fff;
    border-radius:22px;
    padding:25px 30px;
    display:flex;
    align-items:center;
    gap:22px;
    box-shadow:0 8px 30px rgba(47, 90, 56, 0.08);
    transition:all .3s ease;
    border:1px solid #e5eee5;
}

.questionnaire-status-card:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 35px rgba(47, 90, 56, 0.12);
}


/* COMPLETADO */
.questionnaire-completed{
    border-left:6px solid #66bb6a;
    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f1faf2 100%
        );
}


/* PENDIENTE */
.questionnaire-pending{
    border-left:6px solid #a5d6a7;
    background:
        linear-gradient(
            135deg,
            #ffffff 0%,
            #f7fbf5 100%
        );
}


/* ICONO */
.questionnaire-status-icon{
    width:70px;
    height:70px;
    min-width:70px;

    border-radius:20px;

    background:#e6f4e8;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:34px;

    color:#388e3c;
}


.pending-icon{
    background:#eef7e8;
    color:#689f38;
}


/* CONTENIDO */
.questionnaire-status-content{
    flex:1;
}

.questionnaire-status-content h4{
    color:#2f5135;
}


/* ESTADO */
.status-badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
}

.completed-badge{
    background:#dff3e2;
    color:#2e7d32;
}

.pending-badge{
    background:#eef5df;
    color:#558b2f;
}


/* BOTÓN */
.questionnaire-status-action{
    min-width:190px;
    text-align:right;
}

.questionnaire-status-action .btn{
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}


/* RESPONSIVE */
@media(max-width:768px){

    .questionnaire-status-card{
        flex-direction:column;
        text-align:center;
        padding:25px 20px;
    }

    .questionnaire-status-action{
        width:100%;
        min-width:auto;
        text-align:center;
    }

    .questionnaire-status-action .btn{
        width:100%;
    }

}

</style>

@endsection