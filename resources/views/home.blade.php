@extends('layouts.app')

@section('content')

<section class="hero">

<div class="container text-center">

<h1 class="hero-title">
Eleva tus espacios con diseño paisajista inteligente
</h1>

<p class="mt-4 text-muted">

Diseña jardines increíbles utilizando inteligencia artificial y recomendaciones personalizadas.

</p>

<div class="mt-4">

<a href="/renovar-jardin" class="btn btn-main btn-lg">
Renueva mi jardín
</a>

</div>

</div>

</section>



<div class="container mt-5">

<h2 class="text-center mb-5">Estilos de jardín populares</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="card">

<img src="https://images.unsplash.com/photo-1598908314732-07113901949e" class="card-img-top">

<div class="card-body">

<h5>Jardín Moderno</h5>

<p class="text-muted">Diseños minimalistas con vegetación elegante.</p>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card">

<img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae" class="card-img-top">

<div class="card-body">

<h5>Jardín Tropical</h5>

<p class="text-muted">Ambientes naturales con plantas exuberantes.</p>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card">

<img src="https://images.unsplash.com/photo-1598899134739-24c46f58c1a3" class="card-img-top">

<div class="card-body">

<h5>Jardín Minimalista</h5>

<p class="text-muted">Espacios simples con gran estilo.</p>

</div>

</div>

</div>

</div>

</div>

@endsection