@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card p-4">

<h3 class="text-center mb-4">Crear cuenta</h3>

<form method="POST" action="{{ route('register.store') }}">

@csrf

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Confirmar Password</label>
<input type="password" name="password_confirmation" class="form-control" required>
</div>

<button class="btn btn-main w-100">
Registrarse
</button>

</form>

<div class="text-center mt-3">
¿Ya tienes cuenta? 
<a href="{{ route('login') }}">Inicia sesión</a>
</div>

</div>

</div>

</div>

</div>

@endsection