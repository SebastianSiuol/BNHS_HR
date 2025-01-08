<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        // Assign the API key dynamically (retrieved from .env)
        $apiKey = env('AUTH_API_KEY');

        // Attach it to the request attributes (not visible to front-end)
        $request->headers->set('x-auth-api-key', 'asdsadasdasd');
        // $request->attributes->set('x_auth_api_key', $apiKey);

        return $next($request);
    }
}
