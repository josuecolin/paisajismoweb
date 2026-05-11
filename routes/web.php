<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StabilityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TiendaRecomendacionController;

Route::resource('posts', PostController::class);

Route::post('/stability', [StabilityController::class, 'generate'])->name('stability.generate');
/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index']);

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'authenticate'])->name('login.authenticate');

Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'store'])->name('register.store');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/bitacora', [BitacoraController::class, 'index']) ->name('bitacora.index');



Route::middleware('auth')->group(function () {
    Route::get('/mis-preferencias',      [CategoriaController::class, 'preferencias'])
         ->name('categorias.preferencias');
    Route::post('/mis-preferencias',     [CategoriaController::class, 'guardarPreferencias'])
         ->name('categorias.guardarPreferencias');
});

Route::get('/explorar', [PostController::class, 'explorar'])->name('posts.explorar');


/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren sesión)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/projects',[ProjectController::class,'index'])->name('projects');

    Route::get('/renovar-jardin', function () {
        return view('renovar');
    })->name('renovar');

    Route::get('/mis-proyectos', function () {
        return view('mis-proyectos');
    })->name('mis-proyectos');


Route::get('/proyectos-guardados', [PostController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::resource('posts', PostController::class)->except(['index']);
});

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/guardar', [PostController::class, 'toggleGuardar'])
         ->name('posts.guardar');
    Route::get('/proyectos-guardados', [PostController::class, 'guardados'])
         ->name('proyectos-guardados');
});

Route::get('/tiendas-recomendadas', [TiendaRecomendacionController::class, 'index'])
     ->name('tiendas.index');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
 
    Route::get   ('/tiendas',            [TiendaRecomendacionController::class, 'adminIndex'])->name('tiendas.index');
    Route::get   ('/tiendas/crear',      [TiendaRecomendacionController::class, 'create'])    ->name('tiendas.create');
    Route::post  ('/tiendas',            [TiendaRecomendacionController::class, 'store'])     ->name('tiendas.store');
    Route::get   ('/tiendas/{tienda}',   [TiendaRecomendacionController::class, 'edit'])      ->name('tiendas.edit');
    Route::put   ('/tiendas/{tienda}',   [TiendaRecomendacionController::class, 'update'])    ->name('tiendas.update');
    Route::delete('/tiendas/{tienda}',   [TiendaRecomendacionController::class, 'destroy'])   ->name('tiendas.destroy');
 
});

});