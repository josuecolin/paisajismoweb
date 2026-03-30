<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Mostrar publicaciones
public function index()
{
    $posts = Post::with('user')->latest()->get();
    return view('projects', compact('posts')); // 👈 importante
}

    // Formulario
    public function create()
    {
        return view('posts.create');
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'imagen' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('posts', 'public');
        }

        Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'imagen' => $rutaImagen,
            'user_id' => Auth::id()
        ]);

        return redirect('/posts');
    }
}
