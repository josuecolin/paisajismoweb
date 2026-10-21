@extends('layouts.app')

@section('content')
@include('projects._styles')
<div class="pv"><div class="pv-wrap">

    <div class="pv-head">
        <div>
            <h1>Mis proyectos</h1>
            <p class="pv-sub">Diseña tu jardín y conoce su costo antes de construir.</p>
        </div>
        <a href="{{ route('projects.create') }}" class="pv-btn">+ Nuevo proyecto</a>
    </div>

    @if(session('success')) <div class="pv-alert ok">{{ session('success') }}</div> @endif

    @if($projects->isEmpty())
        <div class="pv-card pv-empty">
            <span class="big">🌿</span>
            Aún no tienes proyectos. Crea el primero y empieza a elegir materiales.
        </div>
    @else
        <div class="pv-grid">
            @foreach($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="pv-card pv-project" style="animation-delay:{{ $loop->index * 60 }}ms">
                    <span class="pv-badge {{ $project->status }}">{{ $project->status }}</span>
                    <h3>{{ $project->name }}</h3>
                    <p class="pv-meta">
                        {{ $project->items->count() }} materiales
                        @if($project->area_m2) · {{ $project->area_m2 + 0 }} m² @endif
                    </p>
                    <div class="pv-price">${{ number_format($project->budget()['total'], 2) }} <small style="font:500 .75rem 'DM Sans';color:var(--muted)">MXN</small></div>
                </a>
            @endforeach
        </div>
    @endif

</div></div>
@endsection
