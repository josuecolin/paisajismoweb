@extends('layouts.app')

@section('content')

<section class="py-5">

<div class="container">

<!-- TITULO -->
<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h2 class="fw-bold">🌿 Mis proyectos</h2>
<p class="text-muted mb-0">
Administra y revisa tus diseños de paisajismo
</p>
</div>

<a href="/renovar-jardin" class="btn btn-main">
+ Nuevo proyecto
</a>

</div>


<!-- GRID DE PROYECTOS -->
<div class="row g-4">

@for ($i=1;$i<=4;$i++)

<div class="col-md-3">

<div class="card project-card border-0 shadow-sm">

<img 
src="https://picsum.photos/400/250?random={{$i}}"
class="card-img-top project-img"
>

<div class="card-body">

<div class="d-flex justify-content-between align-items-center">

<h6 class="fw-bold mb-0">
Proyecto {{$i}}
</h6>

<span class="badge bg-success">
Activo
</span>

</div>

<p class="text-muted small mt-2">
Diseño de jardín generado con IA
</p>

<button class="btn btn-main btn-sm w-100">
Abrir proyecto
</button>

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
height:200px;
object-fit:cover;
}

/* BOTON PRINCIPAL */
.btn-main{
background:#ff2e63;
color:white;
border:none;
border-radius:30px;
padding:10px 20px;
}

.btn-main:hover{
background:#e02455;
color:white;
}

</style>

@endsection