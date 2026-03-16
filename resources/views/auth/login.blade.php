@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card p-4">

<h3 class="text-center mb-4">Iniciar sesión</h3>

<form action="/dashboard">

<div class="mb-3">

<label>Email</label>

<input type="email" class="form-control">

</div>

<div class="mb-3">

<label>Password</label>

<input type="password" class="form-control">

</div>

<button class="btn btn-main w-100">
Entrar
</button>

</form>

</div>

</div>

</div>

</div>

@endsection