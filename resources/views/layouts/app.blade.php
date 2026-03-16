<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Paisajismo Inteligente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f6f7fb;
}

.hero{
padding:100px 0;
background:linear-gradient(120deg,#e9f5ff,#ffffff);
}

.hero-title{
font-size:55px;
font-weight:bold;
}

.card{
border:none;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,0.08);
}

.btn-main{
background:#ff2e63;
color:white;
border:none;
padding:12px 25px;
border-radius:30px;
}

.btn-main:hover{
background:#e02455;
color:white;
}

.navbar{
background:white;
box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand fw-bold">Paisajismo IA</a>

<div>

<a href="/login" class="btn btn-outline-dark me-2">Login</a>

<a href="/register" class="btn btn-main">Registrarse</a>

</div>

</div>

</nav>


@yield('content')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>