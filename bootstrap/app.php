<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Agregar CORS como primer middleware en API
        $middleware->api(prepend: [
            \App\Http\Middleware\Cors::class,
        ]);
        
        // CRÍTICO: Remover el middleware VerifyCsrfToken de las rutas API
        $middleware->web(remove: [
            // Mantener CSRF solo en rutas web si es necesario
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();