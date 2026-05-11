<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\TiendaRecomendada;
use Illuminate\Http\Request;

class TiendaRecomendacionController extends Controller
{
    /** Lista de categorías y tiendas filtradas desde la BD */
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        $categoriaSeleccionada = null;
        $tiendas               = collect();

        if ($request->filled('categoria')) {
            $categoriaSeleccionada = $categorias->firstWhere('slug', $request->categoria);

            if ($categoriaSeleccionada) {
                $tiendas = TiendaRecomendada::activas()
                    ->with('tags')
                    ->whereHas('categorias', fn ($q) =>
                        $q->where('categorias.id', $categoriaSeleccionada->id)
                    )
                    ->get();
            }
        }

        return view('tiendas.index', compact(
            'categorias',
            'categoriaSeleccionada',
            'tiendas'
        ));
    }

    // ── CRUD para panel de administración ────────────────────────────────────

    /** Lista todas las tiendas (admin) */
    public function adminIndex()
    {
        $tiendas = TiendaRecomendada::with(['categorias', 'tags'])->latest()->paginate(15);
        return view('admin.tiendas.index', compact('tiendas'));
    }

    /** Formulario de creación (admin) */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.tiendas.form', compact('categorias'));
    }

    /** Guardar nueva tienda (admin) */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'tipo'         => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'icono'        => 'nullable|string|max:10',
            'color'        => 'nullable|string|max:10',
            'sitio_web'    => 'nullable|url',
            'activo'       => 'boolean',
            'categorias'   => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id',
            'tags'         => 'nullable|string', // CSV: "Tag1, Tag2, Tag3"
        ]);

        $tienda = TiendaRecomendada::create($validated);
        $tienda->categorias()->sync($validated['categorias']);

        if (!empty($validated['tags'])) {
            $tags = array_filter(array_map('trim', explode(',', $validated['tags'])));
            foreach ($tags as $tag) {
                $tienda->tags()->create(['tag' => $tag]);
            }
        }

        return redirect()->route('admin.tiendas.index')
                         ->with('success', 'Tienda creada correctamente.');
    }

    /** Formulario de edición (admin) */
    public function edit(TiendaRecomendada $tienda)
    {
        $categorias    = Categoria::orderBy('nombre')->get();
        $seleccionadas = $tienda->categorias->pluck('id')->toArray();
        $tagsStr       = $tienda->tags->pluck('tag')->implode(', ');

        return view('admin.tiendas.form', compact('tienda', 'categorias', 'seleccionadas', 'tagsStr'));
    }

    /** Actualizar tienda (admin) */
    public function update(Request $request, TiendaRecomendada $tienda)
    {
        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'tipo'         => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'icono'        => 'nullable|string|max:10',
            'color'        => 'nullable|string|max:10',
            'sitio_web'    => 'nullable|url',
            'activo'       => 'boolean',
            'categorias'   => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id',
            'tags'         => 'nullable|string',
        ]);

        $tienda->update($validated);
        $tienda->categorias()->sync($validated['categorias']);

        // Re-crear tags
        $tienda->tags()->delete();
        if (!empty($validated['tags'])) {
            $tags = array_filter(array_map('trim', explode(',', $validated['tags'])));
            foreach ($tags as $tag) {
                $tienda->tags()->create(['tag' => $tag]);
            }
        }

        return redirect()->route('admin.tiendas.index')
                         ->with('success', 'Tienda actualizada correctamente.');
    }

    /** Eliminar tienda (admin) */
    public function destroy(TiendaRecomendada $tienda)
    {
        $tienda->delete();
        return redirect()->route('admin.tiendas.index')
                         ->with('success', 'Tienda eliminada.');
    }
}
