@extends('layouts.app')

@section('content')

<style>
    body {
        background:
            linear-gradient(
                135deg,
                #f4fbf5 0%,
                #edf7ef 50%,
                #f8fcf8 100%
            );
    }

    .questionnaire-wrapper {
        min-height: 100vh;
        padding: 45px 0 70px;
    }

    /* Encabezado */
    .questionnaire-header {
        background:
            linear-gradient(
                135deg,
                #dff3e3 0%,
                #cdebd4 100%
            );
        border-radius: 24px;
        padding: 35px 35px 30px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        border: 1px solid #c4e4cb;
    }

    .questionnaire-header::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.35);
        right: -50px;
        top: -70px;
    }

    .questionnaire-header::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        right: 100px;
        bottom: -70px;
    }

    .leaf-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #3f7d4d;
        font-size: 30px;
        box-shadow: 0 8px 20px rgba(54, 105, 67, 0.10);
        margin-bottom: 18px;
    }

    .questionnaire-title {
        color: #275d35;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .questionnaire-description {
        color: #53715c;
        max-width: 720px;
        margin-bottom: 0;
        line-height: 1.7;
    }

    /* Barra de progreso */
    .progress-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px 22px;
        margin-bottom: 25px;
        border: 1px solid #e2eee4;
        box-shadow: 0 8px 24px rgba(46, 91, 56, 0.06);
    }

    .progress-title {
        color: #41664a;
        font-size: 14px;
        font-weight: 600;
    }

    .progress {
        height: 9px;
        background: #edf4ee;
        border-radius: 20px;
    }

    .progress-bar {
        background:
            linear-gradient(
                90deg,
                #87c795,
                #4e9360
            );
        border-radius: 20px;
        transition: width .3s ease;
    }

    /* Tarjeta principal */
    .questionnaire-card {
        border: none;
        border-radius: 24px;
        background: rgba(255,255,255,.96);
        box-shadow: 0 15px 45px rgba(42, 83, 52, 0.08);
        overflow: hidden;
    }

    .questionnaire-card .card-body {
        padding: 30px;
    }

    /* Preguntas */
    .question-card {
        background: #fbfefb;
        border: 1px solid #dfede2;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 22px;
        transition: all .25s ease;
    }

    .question-card:hover {
        transform: translateY(-2px);
        border-color: #b9dcbf;
        box-shadow: 0 10px 25px rgba(52, 99, 64, 0.07);
    }

    .question-number {
        min-width: 42px;
        width: 42px;
        height: 42px;
        border-radius: 13px;
        background: #dff2e3;
        color: #347344;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 700;
        margin-right: 14px;
    }

    .question-text {
        color: #334c39;
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        line-height: 1.5;
    }

    /* Opciones */
    .preference-option {
        height: 100%;
        min-height: 72px;
        border: 1px solid #dce9df;
        border-radius: 14px;
        padding: 12px 10px;
        cursor: pointer;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #607265;
        font-size: 13px;
        font-weight: 500;
        transition: all .2s ease;
        user-select: none;
    }

    .preference-option:hover {
        background: #f0f8f2;
        border-color: #a9d2b2;
        color: #397247;
    }

    .btn-check:checked + .preference-option {
        background:
            linear-gradient(
                135deg,
                #e1f4e5,
                #ccebd3
            );
        border-color: #69a979;
        color: #28643a;
        box-shadow: 0 4px 12px rgba(67, 133, 82, 0.13);
        font-weight: 600;
    }

    .btn-check:checked + .preference-option::before {
        content: "✓";
        margin-right: 6px;
        font-weight: 800;
        color: #368049;
    }

    /* Mensaje */
    .questionnaire-alert {
        background: #fff5f5;
        border: 1px solid #ffd8d8;
        border-radius: 15px;
        color: #a94442;
    }

    /* Botón */
    .btn-save-preferences {
        background:
            linear-gradient(
                135deg,
                #76b986,
                #4d8e5d
            );
        color: #ffffff;
        border: none;
        border-radius: 15px;
        min-height: 55px;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(60, 126, 76, 0.18);
        transition: all .25s ease;
    }

    .btn-save-preferences:hover {
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(60, 126, 76, 0.25);
        background:
            linear-gradient(
                135deg,
                #68ad79,
                #427f51
            );
    }

    .privacy-message {
        text-align: center;
        color: #8a9b8d;
        font-size: 12px;
        margin-top: 15px;
    }

    @media (max-width: 768px) {

        .questionnaire-wrapper {
            padding-top: 20px;
        }

        .questionnaire-header {
            padding: 25px;
        }

        .questionnaire-card .card-body {
            padding: 18px;
        }

        .question-card {
            padding: 18px;
        }

        .question-number {
            min-width: 36px;
            width: 36px;
            height: 36px;
        }
    }
</style>


<div class="questionnaire-wrapper">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-11">


                {{-- ENCABEZADO --}}
                <div class="questionnaire-header">

                    <div class="leaf-icon">
                        <i class="ti ti-leaf"></i>
                    </div>

                    <h2 class="questionnaire-title">
                        Conoce tus preferencias
                    </h2>

                    <p class="questionnaire-description">
                        Queremos ayudarte a encontrar ideas, estilos y proyectos
                        de paisajismo que realmente se adapten a ti.
                        Responde este breve cuestionario y personalizaremos
                        tu experiencia dentro de Garden Valle.
                    </p>

                </div>


                {{-- PROGRESO --}}
                <div class="progress-card">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <span class="progress-title">
                            Progreso del cuestionario
                        </span>

                        <span
                            class="progress-title"
                            id="progressText"
                        >
                            0 de 15 respondidas
                        </span>

                    </div>

                    <div class="progress">

                        <div
                            id="questionProgress"
                            class="progress-bar"
                            role="progressbar"
                            style="width: 0%"
                        ></div>

                    </div>

                </div>


                <div class="card questionnaire-card">

                    <div class="card-body">


                        @if ($errors->any())

                            <div class="alert questionnaire-alert mb-4">

                                <div class="d-flex align-items-center">

                                    <i class="ti ti-alert-circle me-2 fs-5"></i>

                                    <span>
                                        Por favor responde todas las preguntas
                                        antes de guardar tus preferencias.
                                    </span>

                                </div>

                            </div>

                        @endif


                        <form
                            method="POST"
                            action="{{ route('questionnaire.store') }}"
                            id="questionnaireForm"
                        >

                            @csrf


                            @php

                                $questions = [

                                    1 => 'Mi jardín cuenta con un diseño armonioso y organizado.',

                                    2 => 'Estoy interesado en un jardín con una estética natural.',

                                    3 => 'Mi jardín cuenta con una combinación de colores planificada.',

                                    4 => 'Mi jardín tiene elementos decorativos.',

                                    5 => 'Mantengo la apariencia visual de mi jardín.',

                                    6 => 'Cuento con plantas nativas de la región de Valle de Bravo en mi jardín',

                                    7 => 'Mi jardín cuenta con una gran variedad de plantas',

                                    8 => 'Las plantas de mi jardín son fáciles de conseguir en viveros o mercados locales',

                                    9 => 'Mi jardín cuenta con árboles o arbustos en su diseño',

                                    10 => 'Mi jardín cuenta con plantas que florecen en diferentes épocas del año',

                                    11 => 'Invierto al menos 1 hora  a la semana en el cuidado de mi jardín',

                                    12 => 'Mi jardín cuenta con un sistema de riego automatizado ',

                                    13 => 'Mi jardín requiere menos de 2 mantenimientos a la semana',

                                    14 => 'Realiza personalmente el mantenimiento de mi jardín',

                                    15 => 'Mi jardín cuenta con áreas funcionales (como asadores, terrazas u otros espacios de uso)',

                                ];


                                $options = [

                                    1 => 'Muy en desacuerdo',

                                    2 => 'En desacuerdo',

                                    3 => 'Neutral',

                                    4 => 'De acuerdo',

                                    5 => 'Muy de acuerdo',

                                ];

                            @endphp



                            @foreach ($questions as $number => $question)

                                <div class="question-card">

                                    {{-- PREGUNTA --}}
                                    <div class="d-flex align-items-start mb-4">

                                        <div class="question-number">

                                            {{ $number }}

                                        </div>

                                        <div>

                                            <p class="question-text">

                                                {{ $question }}

                                            </p>

                                        </div>

                                    </div>


                                    {{-- OPCIONES --}}
                                    <div class="row g-2">

                                        @foreach ($options as $value => $label)

                                            @php

                                                $selectedValue = old(
                                                    'p'.$number,
                                                    isset($preferences)
                                                        ? $preferences->{'p'.$number}
                                                        : null
                                                );

                                            @endphp


                                            <div class="col-12 col-sm-6 col-lg">

                                                <input
                                                    type="radio"
                                                    class="btn-check preference-radio"
                                                    name="p{{ $number }}"
                                                    value="{{ $value }}"
                                                    id="p{{ $number }}_{{ $value }}"
                                                    autocomplete="off"

                                                    {{ $selectedValue == $value
                                                        ? 'checked'
                                                        : ''
                                                    }}

                                                    required
                                                >


                                                <label
                                                    class="preference-option"
                                                    for="p{{ $number }}_{{ $value }}"
                                                >

                                                    {{ $label }}

                                                </label>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endforeach



                            {{-- BOTÓN --}}
                            <div class="mt-4">

                                <button
                                    type="submit"
                                    class="btn btn-save-preferences w-100"
                                >

                                    <i class="ti ti-leaf me-2"></i>

                                    Guardar mis preferencias

                                </button>


                                <p class="privacy-message">

                                    <i class="ti ti-lock me-1"></i>

                                    Tus respuestas se utilizan únicamente
                                    para personalizar tu experiencia.

                                </p>

                            </div>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const radios = document.querySelectorAll(
        '.preference-radio'
    );

    const totalQuestions = 15;

    const progressBar = document.getElementById(
        'questionProgress'
    );

    const progressText = document.getElementById(
        'progressText'
    );


    function updateProgress() {

        const answeredQuestions = new Set();

        radios.forEach(function (radio) {

            if (radio.checked) {

                answeredQuestions.add(
                    radio.name
                );

            }

        });


        const answered = answeredQuestions.size;

        const percentage =
            (answered / totalQuestions) * 100;


        progressBar.style.width =
            percentage + '%';


        progressText.textContent =
            answered +
            ' de ' +
            totalQuestions +
            ' respondidas';

    }


    radios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            updateProgress
        );

    });


    updateProgress();

});

</script>

@endsection