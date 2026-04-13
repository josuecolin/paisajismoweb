<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StabilityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BitacoraController;

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

});