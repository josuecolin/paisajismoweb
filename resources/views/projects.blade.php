@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2 class="text-center mb-5">
Galería de proyectos paisajistas
</h2>

<div class="row g-4">

@for ($i=1;$i<=6;$i++)

<div class="col-md-4">

<div class="card">

<img src="https://picsum.photos/400/250?random={{$i}}">

<div class="card-body">

<h5>Proyecto {{$i}}</h5>

<button class="btn btn-main">
Ver diseño
</button>

</div>

</div>

</div>

@endfor

</div>

</div>

@endsection