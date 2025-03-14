<?php

namespace App\Http\Controllers\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        // Força que la petició s'interpreti com a API 2 davallcomentades
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
