<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

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

    Route::get('/proyectos-guardados', function () {
        return view('projects');
    })->name('proyectos-guardados');

});