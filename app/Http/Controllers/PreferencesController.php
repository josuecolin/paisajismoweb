<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferencesController extends Controller
{
    public function index()
{
    return view('preferences.index'); // tu vista de preferencias
}
}
