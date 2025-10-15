<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/login', function () {
    return response()->json(['message' => 'No autenticado. Por favor inicia sesión desde la aplicación.'], 401);
})->name('login');