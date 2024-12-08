<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InternalApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $intApiKey = env('AUTH_API_KEY');

        $intApiKeyIsValid = (! empty($intApiKey) && $request->header('x-auth-api-key') == $intApiKey);

        if(!$intApiKeyIsValid) {
            if ($request->expectsJson()){
                return response()->json(["code" => "403",'message'=> "Access Denied!"], Response::HTTP_FORBIDDEN);

            } else {
                abort(403);
            }
        }

        return $next($request);
    }
}
