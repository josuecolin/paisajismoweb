@extends('layouts.app')

@section('content')

<!-- HERO DASHBOARD -->
<section class="hero-dashboard d-flex align-items-center text-center text-white">
    <div class="container hero-content">
        <h1 class="fw-bold display-5">🌿 Panel de Paisajismo</h1>
        <p class="lead">
            Gestiona tus proyectos de jardines y crea nuevos diseños inteligentes.
        </p>
    </div>
</section>


<div class="container py-5">

    <div class="row g-4">

        <!-- CREAR PROYECTO -->
        <div class="col-md-4">
            <div class="card dashboard-card text-white">

                <div class="card-img-overlay d-flex flex-column justify-content-center text-center card-content">

                    <h4 class="fw-bold">🌱 Crear nuevo proyecto</h4>

                    <p>
                        Diseña un nuevo jardín con recomendaciones inteligentes.
                    </p>

                    <a href="/renovar-jardin" class="btn btn-success mt-2">
                        Crear diseño
                    </a>

                </div>

            </div>
        </div>


        <!-- MIS PROYECTOS -->
        <div class="col-md-4">
            <div class="card dashboard-card projects text-white">

                <div class="card-img-overlay d-flex flex-column justify-content-center text-center card-content">

                    <h4 class="fw-bold">🌳 Mis proyectos</h4>

                    <p>
                        Consulta todos los jardines que has creado y edítalos cuando quieras.
                    </p>

                    <a href="/posts" class="btn btn-success mt-2">
                        Ver proyectos
                    </a>

                </div>

            </div>
        </div>


        <!-- PROYECTOS GUARDADOS -->
        <div class="col-md-4">
            <div class="card dashboard-card saved text-white">

                <div class="card-img-overlay d-flex flex-column justify-content-center text-center card-content">

                    <h4 class="fw-bold">🌸 Proyectos guardados</h4>

                    <p>
                        Accede rápidamente a los diseños que guardaste anteriormente.
                    </p>

                    <a href="/proyectos-guardados" class="btn btn-success mt-2">
                        Ver guardados
                    </a>

                </div>

            </div>
        </div>

    </div>

</div>


<style>

/* HERO */
.hero-dashboard{
    height:320px;
    background-image:
    linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6');
    background-size:cover;
    background-position:center;
}

.hero-content{
    text-shadow:0 3px 10px rgba(0,0,0,0.6);
}

/* CARDS */
.dashboard-card{
    height:260px;
    border:none;
    border-radius:15px;
    overflow:hidden;
    background-size:cover;
    background-position:center;
    position:relative;
}

/* IMAGENES CON OVERLAY MÁS OSCURO */
.dashboard-card{
    background-image:
    linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('https://images.unsplash.com/photo-1598908314732-07113901949e');
}

.projects{
    background-image:
    linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('https://images.unsplash.com/photo-1585320806297-9794b3e4eeae');
}

.saved{
    background-image:
    linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('https://images.unsplash.com/photo-1598899134739-24c46f58c1a3');
}

/* CONTENIDO CON FONDO TRANSPARENTE */
.card-content{
    background:rgba(0,0,0,0.35);
    padding:20px;
    border-radius:10px;
}

/* EFECTO HOVER */
.dashboard-card{
    transition:all .3s ease;
}

.dashboard-card:hover{
    transform:scale(1.03);
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
}

</style>

@endsection