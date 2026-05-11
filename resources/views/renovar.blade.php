@extends('layouts.app')

@section('content')

<section class="main-section py-5">

<div class="container">

<div class="row g-5 align-items-start">

    <!-- FORMULARIO -->
    <div class="col-lg-5">

        <div class="glass-card shadow-lg border-0">

            <div class="text-center mb-4">

                <div class="icon-circle">
                    🌿
                </div>

                <h2 class="fw-bold mt-3 text-dark">
                    Crear diseño inteligente
                </h2>

                <p class="text-muted">
                    Sube una fotografía y transforma tu jardín con IA.
                </p>

            </div>

            <!-- FORM -->
            <form id="formIA" enctype="multipart/form-data">
            @csrf

                <!-- INPUT -->
                <div class="mb-3">

                    <label class="form-label fw-bold text-dark">
                        Imagen del jardín
                    </label>

                    <input 
                        type="file" 
                        name="imagen"
                        id="imagenInput"
                        class="form-control custom-input"
                        accept="image/*"
                        required
                    >

                </div>

                <!-- PREVIEW -->
                <img 
                    id="preview"
                    class="img-fluid rounded-4 shadow-sm mt-3 d-none preview-img"
                >


                <!-- PROMPT -->
                <div class="mt-4">

                    <label class="form-label fw-bold text-dark">
                        Describe tu jardín ideal
                    </label>

                    <textarea
                        name="prompt"
                        id="prompt"
                        rows="4"
                        class="form-control custom-input"
                        placeholder="Ej: jardín moderno con iluminación cálida y plantas tropicales"
                        required></textarea>

                </div>


                <!-- ESTILOS -->
                <div class="mt-4">

                    <label class="fw-bold mb-3 d-block text-dark">
                        Estilos rápidos
                    </label>

                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                            class="btn style-btn estilo"
                            data-style="jardín moderno elegante con iluminación LED">
                            Moderno
                        </button>

                        <button type="button"
                            class="btn style-btn estilo"
                            data-style="jardín japonés zen con bambú y piedra">
                            Japonés
                        </button>

                        <button type="button"
                            class="btn style-btn estilo"
                            data-style="jardín tropical con palmeras y flores">
                            Tropical
                        </button>

                        <button type="button"
                            class="btn style-btn estilo"
                            data-style="jardín minimalista moderno">
                            Minimalista
                        </button>

                    </div>

                </div>


                <!-- BOTON -->
                <button type="submit"
                    class="btn btn-success custom-btn w-100 mt-4">

                    🌱 Generar diseño con IA

                </button>

            </form>

        </div>

    </div>



    <!-- RESULTADO -->
    <div class="col-lg-7">

        <div class="result-card shadow-lg">

            <div class="mb-4">

                <h2 class="fw-bold text-dark">
                    🌸 Resultado generado
                </h2>

                <p class="text-muted">
                    Aquí aparecerá el diseño creado por inteligencia artificial.
                </p>

            </div>

            <!-- LOADING -->
            <div id="loading"
                class="text-center d-none py-5">

                <div class="spinner-border text-success"></div>

                <p class="mt-3 text-muted">
                    Generando diseño inteligente...
                </p>

            </div>


            <!-- RESULTADO -->
            <div class="text-center">

                <img 
                    id="resultado"
                    class="img-fluid rounded-4 shadow d-none result-image"
                >

            </div>

        </div>

    </div>

</div>

</div>

</section>



<style>

/* FONDO GENERAL */
body{
    font-family:'Segoe UI', sans-serif;
    background:
    linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
    url('https://images.unsplash.com/photo-1494526585095-c41746248156');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    min-height:100vh;
}

/* ESPACIADO */
.main-section{
    min-height:100vh;
}

/* TARJETAS */
.glass-card,
.result-card{
    background:rgba(255,255,255,0.92);
    border-radius:30px;
    padding:35px;
    backdrop-filter: blur(10px);
}

/* ICONO */
.icon-circle{
    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:linear-gradient(135deg,#43a047,#81c784);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    color:white;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

/* INPUTS */
.custom-input{
    border-radius:15px;
    border:1px solid #dfe6dd;
    padding:12px;
    transition:.3s;
}

.custom-input:focus{
    border-color:#43a047;
    box-shadow:0 0 0 .2rem rgba(67,160,71,.2);
}

/* BOTON PRINCIPAL */
.custom-btn{
    border:none;
    border-radius:15px;
    padding:14px;
    font-weight:bold;
    transition:.3s;
}

.custom-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(67,160,71,.3);
}

/* BOTONES DE ESTILO */
.style-btn{
    border-radius:30px;
    padding:10px 18px;
    border:1px solid #43a047;
    color:#43a047;
    background:white;
    transition:.3s;
}

.style-btn:hover{
    background:#43a047;
    color:white;
}

/* PREVIEW */
.preview-img{
    width:100%;
    max-height:250px;
    object-fit:cover;
}

/* RESULTADO */
.result-image{
    width:100%;
    max-height:650px;
    object-fit:cover;
    border-radius:25px;
}

/* EFECTOS */
.glass-card:hover,
.result-card:hover{
    transform:translateY(-5px);
    transition:.3s;
}

/* RESPONSIVE */
@media(max-width:768px){

    .glass-card,
    .result-card{
        padding:25px;
    }

}

</style>



<script>

// PREVIEW
document.getElementById('imagenInput').addEventListener('change', function(e){

    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if(file){

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');

    }

});


// ESTILOS RAPIDOS
document.querySelectorAll('.estilo').forEach(btn => {

    btn.addEventListener('click', function(){

        document.getElementById('prompt').value = this.dataset.style;

    });

});


// FORM
document.getElementById('formIA').addEventListener('submit', function(e){

    e.preventDefault();

    let formData = new FormData(this);

    let loading = document.getElementById('loading');
    let resultado = document.getElementById('resultado');
    let boton = this.querySelector('button[type="submit"]');

    loading.classList.remove('d-none');
    resultado.classList.add('d-none');

    boton.disabled = true;
    boton.innerHTML = 'Generando diseño...';

    fetch('/stability', {

        method:'POST',

        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },

        body:formData

    })

    .then(res => res.json())

    .then(data => {

        loading.classList.add('d-none');

        boton.disabled = false;
        boton.innerHTML = '🌱 Generar diseño con IA';

        if(data.error){

            alert(data.error);
            return;

        }

        resultado.src = data.imagen;
        resultado.classList.remove('d-none');

    })

    .catch(err => {

        loading.classList.add('d-none');

        boton.disabled = false;
        boton.innerHTML = '🌱 Generar diseño con IA';

        console.error(err);

        alert('Error al generar imagen');

    });

});

</script>

@endsection