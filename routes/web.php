<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class,'index']);

Route::get('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'register']);

Route::get('/dashboard',[DashboardController::class,'index']);

Route::get('/projects',[ProjectController::class,'index']);

Route::get('/renovar-jardin', function () {
    return view('renovar');
});

Route::get('/mis-proyectos', function () {
    return view('mis-proyectos');
});

Route::get('/proyectos-guardados', function () {
    return view('projects');
});