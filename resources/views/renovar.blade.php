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
Sube una foto de tu jardín y describe cómo quieres transformarlo.
</p>

<!-- FORMULARIO -->
<form id="formIA" enctype="multipart/form-data">
@csrf

<!-- INPUT FILE -->
<input type="file" name="imagen" id="imagenInput" 
    class="form-control mt-3" accept="image/*" required>

<!-- PREVIEW -->
<img id="preview" class="img-fluid rounded mt-3 d-none"/>

<!-- PROMPT -->
<textarea name="prompt" id="prompt" 
    class="form-control mt-3" rows="3"
    placeholder="Ej: jardín moderno con iluminación y plantas tropicales"
    required></textarea>

<!-- ESTILOS (PRO 🔥) -->
<div class="mt-3">
    <label class="fw-bold">Selecciona un estilo:</label>
    <div class="d-flex gap-2 flex-wrap mt-2">
        <button type="button" class="btn btn-outline-success estilo" data-style="jardín moderno">Moderno</button>
        <button type="button" class="btn btn-outline-success estilo" data-style="jardín japonés zen">Japonés</button>
        <button type="button" class="btn btn-outline-success estilo" data-style="jardín tropical con palmeras">Tropical</button>
        <button type="button" class="btn btn-outline-success estilo" data-style="jardín minimalista elegante">Minimalista</button>
    </div>
</div>

<!-- BOTON -->
<button type="submit" class="btn btn-success btn-lg mt-3 w-100">
    Generar diseño con IA
</button>

</form>

</div>

</div>


<!-- RESULTADO -->
<div class="col-md-6 text-center">

<h2 class="fw-bold display-6">
🌿 Resultado generado
</h2>

<p class="text-muted">
Aquí aparecerá tu diseño generado con IA
</p>

<!-- LOADING -->
<div id="loading" class="d-none">
    <div class="spinner-border text-success mt-4"></div>
    <p class="mt-2">Generando diseño...</p>
</div>

<!-- IMAGEN RESULTADO -->
<img id="resultado" class="img-fluid rounded shadow mt-4 d-none"/>

</div>

</div>

</div>

</section>


<style>
.upload-card{
border-radius:20px;
transition:all .3s ease;
background:linear-gradient(135deg,#ffffff,#f8f9fa);
}
.upload-card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,0.15);
}
</style>


<script>

// PREVISUALIZAR IMAGEN
document.getElementById('imagenInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if(file){
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    }
});


// BOTONES DE ESTILO (PRO 🔥)
document.querySelectorAll('.estilo').forEach(btn => {
    btn.addEventListener('click', function(){
        let prompt = document.getElementById('prompt');
        prompt.value = this.dataset.style;
    });
});


// ENVIAR FORMULARIO
// ENVIAR FORMULARIO
document.getElementById('formIA').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);
    let loading = document.getElementById('loading');
    let resultado = document.getElementById('resultado');
    let btnPublicar = this.querySelector('button[type="submit"]'); // 👈 Captura el botón

    // UI: Bloquear para evitar doble envío
    loading.classList.remove('d-none');
    resultado.classList.add('d-none');
    btnPublicar.disabled = true; // 👈 Deshabilita el botón
    btnPublicar.innerText = 'Procesando...';

    fetch('/stability', { 
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        loading.classList.add('d-none');
        btnPublicar.disabled = false; // 👈 Habilita de nuevo
        btnPublicar.innerText = 'Generar diseño con IA';

        if(data.error){
            alert(data.error);
            return;
        }

        resultado.src = data.imagen;
        resultado.classList.remove('d-none');
    })
    .catch(err => {
        loading.classList.add('d-none');
        btnPublicar.disabled = false;
        btnPublicar.innerText = 'Generar diseño con IA';
        console.error(err);
        alert('Error al generar imagen');
    });
});

</script>

@endsection