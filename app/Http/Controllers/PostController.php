<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Mostrar listado de publicaciones
     */
    public function index()
    {
        $posts = Post::with('user')
                     ->latest()
                     ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Guardar nueva publicación
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255|min:5',
            'contenido'=> 'required|string|min:10',
            'imagen'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'titulo.required'    => 'El título es obligatorio.',
            'titulo.min'         => 'El título debe tener al menos 5 caracteres.',
            'contenido.required' => 'La descripción es obligatoria.',
            'contenido.min'      => 'La descripción debe tener al menos 10 caracteres.',
            'imagen.image'       => 'El archivo debe ser una imagen válida.',
            'imagen.max'         => 'La imagen no puede superar los 2MB.',
        ]);

        $data = [
            'titulo'   => $request->titulo,
            'contenido'=> $request->contenido,
            'user_id'  => Auth::id(),
        ];

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                                      ->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index')
                         ->with('success', '¡Publicación creada exitosamente! 🌱');
    }

    /**
     * Mostrar una publicación individual
     */
    public function show(Post $post)
    {
        $post->load('user');
        return view('posts.show', compact('post'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Post $post)
    {
        // Opcional: solo el autor puede editar
        // $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Actualizar publicación existente
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255|min:5',
            'contenido'=> 'required|string|min:10',
            'imagen'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'titulo.required'    => 'El título es obligatorio.',
            'titulo.min'         => 'El título debe tener al menos 5 caracteres.',
            'contenido.required' => 'La descripción es obligatoria.',
            'contenido.min'      => 'La descripción debe tener al menos 10 caracteres.',
            'imagen.image'       => 'El archivo debe ser una imagen válida.',
            'imagen.max'         => 'La imagen no puede superar los 2MB.',
        ]);

        $data = [
            'titulo'   => $request->titulo,
            'contenido'=> $request->contenido,
        ];

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($post->imagen) {
                Storage::disk('public')->delete($post->imagen);
            }
            $data['imagen'] = $request->file('imagen')
                                      ->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.show', $post)
                         ->with('success', '¡Publicación actualizada correctamente! ✨');
    }

    /**
     * Eliminar publicación
     */
    public function destroy(Post $post)
    {
        // Eliminar imagen del storage si existe
        if ($post->imagen) {
            Storage::disk('public')->delete($post->imagen);
        }

        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Publicación eliminada correctamente.');
    }
}