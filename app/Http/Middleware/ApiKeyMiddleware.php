<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = env('API_KEY');

        $apiKeyIsValid = (! empty($apiKey) && $request->header('X-API-KEY') == $apiKey);

        if(!$apiKeyIsValid) {
            return response()->json(['error' => 'Access Denied'], 403);
        }

        return $next($request);
    }
}
