<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigins = [
            'https://biblioteca-personal-front-end.vercel.app',
            'https://biblioteca-personal-frontend.vercel.app',
            'https://biblioteca-personal-frontend-seven.vercel.app',
            'http://localhost:5173',
            'http://localhost:3000',
        ];

        $origin = $request->headers->get('Origin');
        $allowOrigin = in_array($origin, $allowedOrigins) ? $origin : null;

        if ($request->getMethod() === "OPTIONS") {
            return response("", 200)
                ->header('Access-Control-Allow-Origin', $allowOrigin ?: 'https://biblioteca-personal-front-end.vercel.app')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Max-Age', '86400');
        }

        $response = $next($request);

        return $response
            ->header('Access-Control-Allow-Origin', $allowOrigin ?: 'https://biblioteca-personal-front-end.vercel.app')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}