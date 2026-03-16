@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2>Mis proyectos</h2>

<div class="row g-4 mt-3">

@for ($i=1;$i<=4;$i++)

<div class="col-md-3">

<div class="card">

<img src="https://picsum.photos/300/200?random={{$i}}">

<div class="card-body">

<h6>Proyecto {{$i}}</h6>

<button class="btn btn-main btn-sm">
Abrir
</button>

</div>

</div>

</div>

@endfor

</div>

</div>

@endsection