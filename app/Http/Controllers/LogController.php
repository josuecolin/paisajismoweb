<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
{
    $logPath = storage_path('logs/laravel.log');

    if (!file_exists($logPath)) {
        return view('logs', ['logs' => []]);
    }

    $logs = explode("\n", file_get_contents($logPath));

    return view('logs', compact('logs'));
}
}