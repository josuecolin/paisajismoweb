@extends('layouts.app')

@section('content')

<section class="py-5">

<div class="container">

<!-- TITULO -->
<div class="text-center mb-5">

<h2 class="fw-bold display-6">
🌿 Galería de proyectos paisajistas
</h2>

<p class="text-muted">
Explora algunos diseños de jardines generados con inteligencia artificial
</p>

</div>


<div class="row g-4">

@for ($i=1;$i<=6;$i++)

<div class="col-md-4">

<div class="card project-card border-0 shadow-sm">

<div class="image-container">

<img 
src="https://picsum.photos/500/300?random={{$i}}" 
class="card-img-top project-img"
>

<div class="overlay">

<button class="btn btn-light btn-sm">
Ver diseño
</button>

</div>

</div>

<div class="card-body text-center">

<h5 class="fw-bold">
Proyecto {{$i}}
</h5>

<p class="text-muted small">
Diseño paisajista generado con IA
</p>

</div>

</div>

</div>

@endfor

</div>

</div>

</section>


<style>

/* TARJETAS */
.project-card{
border-radius:18px;
overflow:hidden;
transition:all .3s ease;
}

.project-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

/* IMAGEN */
.project-img{
height:240px;
object-fit:cover;
}

/* CONTENEDOR DE IMAGEN */
.image-container{
position:relative;
overflow:hidden;
}

/* OVERLAY */
.overlay{
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.45);
display:flex;
align-items:center;
justify-content:center;
opacity:0;
transition:all .3s ease;
}

.image-container:hover .overlay{
opacity:1;
}

</style>

@endsection