<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Middleware globales de Laravel
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        //\App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareAliases = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'api' =>  \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'json.response' => \App\Http\Middleware\ForceJsonResponse::class, // Si ForceJsonResponse es necesario
    ];

}
