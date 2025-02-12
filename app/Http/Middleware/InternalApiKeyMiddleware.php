<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

class InternalApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $intApiKey = Config::get('app.internal-api-key');

        // $intApiKeyIsValid = (! empty($intApiKey) && $request->header('x-auth-api-key') == $intApiKey);


        if($request->isJson()) {
            return $next($request);

        } else {
            abort(403);
        }

        // return $next($request);
    }
}
