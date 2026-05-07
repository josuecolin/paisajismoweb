<?php
 
namespace App\Http\Controllers;
 
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Mostrar selector de preferencias del usuario
     */
    public function preferencias()
    {
        $categorias         = Categoria::orderBy('nombre')->get();
        $seleccionadas      = Auth::user()->categoriasPreferidas->pluck('id')->toArray();
 
        return view('categorias.preferencias', compact('categorias', 'seleccionadas'));
    }
 
    /**
     * Guardar preferencias del usuario (sync many-to-many)
     */
    public function guardarPreferencias(Request $request)
    {
        $request->validate([
            'categorias'   => 'nullable|array',
            'categorias.*' => 'exists:categorias,id',
        ]);
 
        Auth::user()->categoriasPreferidas()->sync(
            $request->input('categorias', [])
        );
 
        return redirect()->back()
                         ->with('success', '¡Tus preferencias han sido guardadas! 🌿');
    }
}
 