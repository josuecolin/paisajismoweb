<?php
 
namespace App\Http\Controllers;
 
use App\Models\Post;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 
class PostController extends Controller
{
    public function index()
{
    $posts = Post::with(['user', 'categorias'])
                 ->where('user_id', Auth::id())  // ← solo los suyos
                 ->latest()
                 ->paginate(9);

    return view('posts.index', compact('posts'));
}
 
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('posts.create', compact('categorias'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255|min:5',
            'contenido'    => 'required|string|min:10',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categorias'   => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id',
        ], [
            'titulo.required'      => 'El título es obligatorio.',
            'titulo.min'           => 'El título debe tener al menos 5 caracteres.',
            'contenido.required'   => 'La descripción es obligatoria.',
            'contenido.min'        => 'La descripción debe tener al menos 10 caracteres.',
            'imagen.image'         => 'El archivo debe ser una imagen válida.',
            'imagen.max'           => 'La imagen no puede superar los 2MB.',
            'categorias.required'  => 'Selecciona al menos una categoría.',
            'categorias.min'       => 'Selecciona al menos una categoría.',
        ]);
 
        $data = [
            'titulo'    => $request->titulo,
            'contenido' => $request->contenido,
            'user_id'   => Auth::id(),
        ];
 
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('posts', 'public');
        }
 
        $post = Post::create($data);
        $post->categorias()->sync($request->categorias);
 
        return redirect()->route('posts.index')
                         ->with('success', '¡Publicación creada exitosamente! 🌱');
    }
 
    public function show(Post $post)
{
    // Cualquiera puede ver el detalle en explorar,
    // pero si viene de /posts verificamos que sea el dueño
    $post->load(['user', 'categorias']);
    return view('posts.show', compact('post'));
}
 
    public function edit(Post $post)
{
    // Solo el autor puede editar
    if ($post->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para editar esta publicación.');
    }

    $categorias    = Categoria::orderBy('nombre')->get();
    $seleccionadas = $post->categorias->pluck('id')->toArray();

    return view('posts.edit', compact('post', 'categorias', 'seleccionadas'));
}
 
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
        abort(403);
    }
        $request->validate([
            'titulo'       => 'required|string|max:255|min:5',
            'contenido'    => 'required|string|min:10',
            'imagen'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categorias'   => 'required|array|min:1',
            'categorias.*' => 'exists:categorias,id',
        ], [
            'categorias.required' => 'Selecciona al menos una categoría.',
            'categorias.min'      => 'Selecciona al menos una categoría.',
        ]);
 
        $data = [
            'titulo'    => $request->titulo,
            'contenido' => $request->contenido,
        ];
 
        if ($request->hasFile('imagen')) {
            if ($post->imagen) {
                Storage::disk('public')->delete($post->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('posts', 'public');
        }
 
        $post->update($data);
        $post->categorias()->sync($request->categorias);
 
        return redirect()->route('posts.show', $post)
                         ->with('success', '¡Publicación actualizada correctamente! ✨');
    }
 
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
        abort(403);
    }
    
        if ($post->imagen) {
            Storage::disk('public')->delete($post->imagen);
        }
        $post->categorias()->detach();
        $post->delete();
 
        return redirect()->route('posts.index')
                         ->with('success', 'Publicación eliminada correctamente.');
    }

    public function explorar()
{
    $posts = Post::with(['user', 'categorias'])
                 ->latest()
                 ->paginate(12);

    return view('posts.explorar', compact('posts'));
}
}