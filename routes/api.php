<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\BookController;

// Ruta de prueba
Route::get('/', function () {
    return ['message' => 'API funcionando correctamente'];
});

// Rutas públicas (sin autenticación)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // CRUD de libros
    Route::apiResource('books', BookController::class);
});