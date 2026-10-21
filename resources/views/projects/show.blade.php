@extends('layouts.app')

@section('content')
@include('projects._styles')
<div class="pv"><div class="pv-wrap">

    <div class="pv-head">
        <div>
            <a href="{{ route('projects.index') }}" style="font-size:.85rem">← Mis proyectos</a>
            <h1 style="margin-top:.4rem">{{ $project->name }}</h1>
            <p class="pv-sub">
                <span class="pv-badge {{ $project->status }}" style="margin:0 .4rem 0 0">{{ $project->status }}</span>
                @if($project->area_m2) {{ $project->area_m2 + 0 }} m² @endif
                @if($project->description) · {{ $project->description }} @endif
            </p>
        </div>
    </div>

    @if(session('success')) <div class="pv-alert ok">{{ session('success') }}</div> @endif
    @if($errors->any()) <div class="pv-alert err">{{ $errors->first() }}</div> @endif

    <div class="pv-layout">

        {{-- Catálogo --}}
        <section>
            <h2>Catálogo de materiales</h2>
            <div class="pv-chips">
                <a href="{{ route('projects.show', $project) }}" class="pv-chip {{ !$category ? 'active' : '' }}">Todos</a>
                @foreach($categories as $cat)
                    <a href="{{ route('projects.show', [$project, 'category' => $cat]) }}"
                       class="pv-chip {{ $cat === $category ? 'active' : '' }}">{{ ucfirst($cat) }}</a>
                @endforeach
            </div>

            <div class="pv-materials">
                @foreach($materials as $m)
                    <form method="POST" action="{{ route('projects.items.store', $project) }}"
                          class="pv-material" style="animation-delay:{{ min($loop->index, 12) * 35 }}ms">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $m->id }}">
                        <div class="cat">{{ $m->category }}</div>
                        <div class="name">{{ $m->name }}</div>
                        <div class="price">${{ number_format($m->unit_price, 2) }} / {{ $m->unit }}</div>
                        <div class="pv-add">
                            <input type="number" name="quantity" step="0.01" min="0.01" value="1">
                            <button class="pv-btn sm">Agregar</button>
                        </div>
                    </form>
                @endforeach
            </div>
        </section>

        {{-- Presupuesto --}}
        <aside class="pv-card pv-panel">
            <h2>Presupuesto</h2>

            @if($project->items->isEmpty())
                <div class="pv-empty" style="padding:1.5rem 0">
                    <span class="big">🪴</span>
                    Agrega materiales desde el catálogo.
                </div>
            @else
                <table class="pv-table">
                    <thead>
                        <tr><th>Material</th><th>Cant.</th><th class="right">Importe</th><th></th></tr>
                    </thead>
                    <tbody>
                    @foreach($project->items as $item)
                        <tr>
                            <td>
                                {{ $item->material->name }}<br>
                                <small style="color:var(--muted)">${{ number_format($item->unit_price, 2) }} / {{ $item->material->unit }}</small>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('projects.items.update', [$project, $item]) }}" class="qty">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" step="0.01" min="0.01" value="{{ $item->quantity }}" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="right">${{ number_format($item->total, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('projects.items.destroy', [$project, $item]) }}">
                                    @csrf @method('DELETE')
                                    <button class="pv-icon-btn" title="Quitar">✕</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <div class="pv-sum">
                <div><span>Materiales</span><span>${{ number_format($budget['materials'], 2) }}</span></div>
                <div><span>Mano de obra ({{ $project->labor_percent + 0 }}%)</span><span>${{ number_format($budget['labor'], 2) }}</span></div>
                <div><span>Imprevistos ({{ $project->contingency_percent + 0 }}%)</span><span>${{ number_format($budget['contingency'], 2) }}</span></div>
                <div><span>IVA ({{ $project->tax_percent + 0 }}%)</span><span>${{ number_format($budget['tax'], 2) }}</span></div>
            </div>

            <div class="pv-total">
                <span>Total estimado (MXN)</span>
                <strong>${{ number_format($budget['total'], 2) }}</strong>
            </div>

            <details>
                <summary>Ajustar porcentajes</summary>
                <form method="POST" action="{{ route('projects.update', $project) }}" class="pv-form">
                    @csrf @method('PUT')
                    <div class="pct">
                        <div><label>Mano de obra %</label><input type="number" step="0.01" name="labor_percent" value="{{ $project->labor_percent }}"></div>
                        <div><label>Imprevistos %</label><input type="number" step="0.01" name="contingency_percent" value="{{ $project->contingency_percent }}"></div>
                        <div><label>IVA %</label><input type="number" step="0.01" name="tax_percent" value="{{ $project->tax_percent }}"></div>
                    </div>
                    <button class="pv-btn sm">Guardar</button>
                </form>
            </details>
        </aside>

    </div>
</div></div>
@endsection
