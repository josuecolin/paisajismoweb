@extends('layouts.app')

@section('content')

<section class="py-5">

<div class="container">

<div class="row align-items-center g-5">

<!-- CARD SUBIR FOTO -->
<div class="col-md-6">

<div class="card shadow-lg border-0 p-4 upload-card text-center">

<div class="mb-3" style="font-size:50px;">
📷
</div>

<h3 class="fw-bold">
Comienza tu diseño con una foto
</h3>

<p class="text-muted mt-3">
Sube una foto de tu jardín y genera nuevas ideas de paisajismo
utilizando inteligencia artificial.
</p>

<button class="btn btn-success btn-lg mt-3">
Añadir una foto
</button>

</div>

</div>


<!-- TEXTO PROMOCIONAL -->
<div class="col-md-6">

<h2 class="fw-bold display-6">
🌿 Diseña instantáneamente tu jardín ideal
</h2>

<p class="mt-4 text-muted lead">

Nuestra herramienta analiza tu jardín y propone diseños
personalizados según el estilo que prefieras.

Transforma tu espacio exterior en un lugar único con
recomendaciones inteligentes.

</p>

<div class="mt-4">

<button class="btn btn-main btn-lg me-2">
Generar diseño
</button>

<button class="btn btn-outline-success btn-lg">
Explorar estilos
</button>

</div>

</div>

</div>

</div>

</section>


<style>

/* CARD PRINCIPAL */
.upload-card{
border-radius:20px;
transition:all .3s ease;
background:linear-gradient(135deg,#ffffff,#f8f9fa);
}

.upload-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

/* BOTON PRINCIPAL */
.btn-main{
background:#ff2e63;
color:white;
border:none;
border-radius:30px;
padding:12px 25px;
}

.btn-main:hover{
background:#e02455;
color:white;
}

</style>

@endsection