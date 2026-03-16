@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2 class="mb-4">Mi Panel de Usuario</h2>

<div class="row g-4">

<div class="col-md-4">
<div class="card p-4 text-center">

<h5>Crear nuevo proyecto</h5>

<p class="text-muted">Diseña un nuevo jardín</p>

<a href="/renovar-jardin" class="btn btn-main">
Crear diseño
</a>

</div>
</div>


<div class="col-md-4">
<div class="card p-4 text-center">

<h5>Mis proyectos</h5>

<p class="text-muted">Proyectos que has creado</p>

<a href="/mis-proyectos" class="btn btn-main">
Ver proyectos
</a>

</div>
</div>


<div class="col-md-4">
<div class="card p-4 text-center">

<h5>Proyectos guardados</h5>

<p class="text-muted">Diseños que guardaste</p>

<a href="/proyectos-guardados" class="btn btn-main">
Ver guardados
</a>

</div>
</div>

</div>

</div>

@endsection