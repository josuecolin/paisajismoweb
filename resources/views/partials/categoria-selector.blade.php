{{--
    PARTIAL: resources/views/partials/categoria-selector.blade.php
    
    Uso en create.blade.php y edit.blade.php:
    @include('partials.categoria-selector', [
        'categorias'    => $categorias,
        'seleccionadas' => $seleccionadas ?? [],
    ])
--}}
 
<style>
    .cat-selector-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.6rem;
        margin-top: 0.6rem;
    }
    .cat-sel-card {
        position: relative;
    }
    .cat-sel-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
    }
    .cat-sel-label {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        padding: 0.75rem 1rem;
        border: 1.5px solid rgba(0,0,0,0.09);
        border-radius: 12px;
        cursor: pointer;
        background: #fff;
        transition: all 0.18s ease;
        font-size: 0.88rem;
        font-weight: 500;
        color: #3D2B1F;
    }
    .cat-sel-card input:checked + .cat-sel-label {
        border-color: #6FA845;
        background: rgba(111,168,69,0.07);
        box-shadow: 0 0 0 2px rgba(111,168,69,0.18);
    }
    .cat-sel-label:hover {
        border-color: rgba(111,168,69,0.45);
        background: rgba(111,168,69,0.04);
    }
    .cat-sel-icon {
        font-size: 1.1rem;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px; height: 30px;
        border-radius: 8px;
        flex-shrink: 0;
    }
    .cat-sel-nombre { flex: 1; line-height: 1.3; }
    .cat-sel-tick {
        width: 16px; height: 16px;
        border-radius: 50%;
        border: 1.5px solid rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s;
        flex-shrink: 0;
        background: #fff;
    }
    .cat-sel-card input:checked + .cat-sel-label .cat-sel-tick {
        background: #6FA845;
        border-color: #6FA845;
    }
    .cat-sel-tick::after {
        content: '';
        display: block;
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #fff;
        opacity: 0;
        transform: scale(0);
        transition: all 0.15s;
    }
    .cat-sel-card input:checked + .cat-sel-label .cat-sel-tick::after {
        opacity: 1;
        transform: scale(1);
    }
    .cat-sel-error {
        color: #b91c1c;
        font-size: 0.82rem;
        font-weight: 600;
        margin-top: 0.4rem;
    }
    .cat-sel-hint {
        font-size: 0.8rem;
        color: #8a9e8a;
        margin-top: 0.4rem;
    }
    .cat-sel-counter {
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        color: #4A7C2F;
        margin-top: 0.5rem;
        transition: color 0.2s;
    }
</style>
 
<div>
    <div class="cat-selector-grid" id="catSelectorGrid">
        @foreach($categorias as $cat)
        <div class="cat-sel-card">
            <input
                type="checkbox"
                name="categorias[]"
                id="catsel_{{ $cat->id }}"
                value="{{ $cat->id }}"
                class="cat-sel-checkbox"
                {{ in_array($cat->id, $seleccionadas ?? []) ? 'checked' : '' }}
            >
            <label class="cat-sel-label" for="catsel_{{ $cat->id }}">
                <div class="cat-sel-icon" style="background: {{ $cat->color }}20;">
                    {{ $cat->icono }}
                </div>
                <span class="cat-sel-nombre">{{ $cat->nombre }}</span>
                <div class="cat-sel-tick"></div>
            </label>
        </div>
        @endforeach
    </div>
 
    @error('categorias')
        <p class="cat-sel-error">{{ $message }}</p>
    @enderror
 
    <p class="cat-sel-hint">Puedes elegir varias categorías.</p>
    <p class="cat-sel-counter" id="catSelCounter">0 categorías seleccionadas</p>
</div>
 
<script>
(function() {
    const boxes   = document.querySelectorAll('.cat-sel-checkbox');
    const counter = document.getElementById('catSelCounter');
 
    function update() {
        const n = [...boxes].filter(b => b.checked).length;
        counter.textContent = n === 0 ? '0 categorías seleccionadas'
                            : n === 1 ? '1 categoría seleccionada'
                            : `${n} categorías seleccionadas`;
        counter.style.color = n > 0 ? '#3D6B27' : '#8a9e8a';
    }
 
    boxes.forEach(b => b.addEventListener('change', update));
    update();
})();
</script>