@extends('layouts.app')

@section('content')
@include('projects._styles')
<div class="pv"><div class="pv-wrap" style="max-width:620px">

    <div class="pv-head">
        <div>
            <h1>Nuevo proyecto</h1>
            <p class="pv-sub">Cuéntanos lo básico; los materiales los eliges en el siguiente paso.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('projects.store') }}" class="pv-card pv-form">
        @csrf
        <div class="field">
            <label for="name">Nombre del proyecto</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. Jardín frontal" required>
            @error('name') <span class="err-text">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="3" placeholder="Estilo, zonas, ideas...">{{ old('description') }}</textarea>
        </div>
        <div class="field">
            <label for="area_m2">Superficie (m²)</label>
            <input type="number" step="0.01" id="area_m2" name="area_m2" value="{{ old('area_m2') }}">
            @error('area_m2') <span class="err-text">{{ $message }}</span> @enderror
        </div>
        <div style="display:flex;gap:.6rem">
            <button class="pv-btn">Crear y elegir materiales</button>
            <a href="{{ route('projects.index') }}" class="pv-btn ghost">Cancelar</a>
        </div>
    </form>

</div></div>
@endsection
