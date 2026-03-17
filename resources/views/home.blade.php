@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero-section d-flex align-items-center text-center text-white">

<div class="container">

<h1 class="display-3 fw-bold">
🌿 Eleva tus espacios con paisajismo inteligente
</h1>

<p class="lead mt-4">
Diseña jardines increíbles utilizando inteligencia artificial
y recomendaciones personalizadas.
</p>

<a href="/renovar-jardin" class="btn btn-success btn-lg mt-4 px-5">
Renueva mi jardín
</a>

</div>

</section>



<!-- ESTILOS DE JARDÍN -->
<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold display-6">
Estilos de jardín populares
</h2>

<p class="text-muted">
Encuentra inspiración para transformar tu espacio exterior
</p>

</div>

<div class="row g-4">

<!-- CARD 1 -->
<div class="col-md-4">

<div class="card garden-card border-0 shadow-sm h-100">

<img 
src="https://images.unsplash.com/photo-1598908314732-07113901949e"
class="card-img-top garden-img"
>

<div class="card-body text-center">

<div style="font-size:30px">🏡</div>

<h5 class="fw-bold mt-2">
Jardín Moderno
</h5>

<p class="text-muted">
Diseños minimalistas con vegetación elegante
y líneas arquitectónicas limpias.
</p>

<button class="btn btn-outline-success">
Explorar
</button>

</div>

</div>

</div>


<!-- CARD 2 -->
<div class="col-md-4">

<div class="card garden-card border-0 shadow-sm h-100">

<img 
src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae"
class="card-img-top garden-img"
>

<div class="card-body text-center">

<div style="font-size:30px">🌴</div>

<h5 class="fw-bold mt-2">
Jardín Tropical
</h5>

<p class="text-muted">
Ambientes naturales con plantas exuberantes
que generan un espacio fresco y relajante.
</p>

<button class="btn btn-outline-success">
Explorar
</button>

</div>

</div>

</div>


<!-- CARD 3 -->
<div class="col-md-4">

<div class="card garden-card border-0 shadow-sm h-100">

<img 
src="https://images.unsplash.com/photo-1598899134739-24c46f58c1a3"
class="card-img-top garden-img"
>

<div class="card-body text-center">

<div style="font-size:30px">🌿</div>

<h5 class="fw-bold mt-2">
Jardín Minimalista
</h5>

<p class="text-muted">
Espacios simples con pocos elementos
pero con gran impacto visual.
</p>

<button class="btn btn-outline-success">
Explorar
</button>

</div>

</div>

</div>

</div>

</div>

</section>


<style>

/* HERO */
.hero-section{
height:420px;
background-image:
linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6');
background-size:cover;
background-position:center;
}


/* TARJETAS */
.garden-card{
border-radius:18px;
overflow:hidden;
transition:all .3s ease;
}

.garden-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

/* IMAGENES */
.garden-img{
height:220px;
object-fit:cover;
}

</style>

@endsection