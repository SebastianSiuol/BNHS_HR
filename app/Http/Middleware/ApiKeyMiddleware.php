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

//        return response()->json(['api-key' => $apiKey]);

        $apiKeyIsValid = (! empty($apiKey) && $request->header('x-api-key') == $apiKey);

        if(!$apiKeyIsValid) {
            return response()->json(['error' => 'Access Denied'], 403);
        }

        return $next($request);
    }
}
