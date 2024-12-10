<?php

use App\Http\Middleware\InternalApiKeyMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Request;

use App\Http\Middleware\ExternalApiKeyMiddleware;
use App\Http\Middleware\CheckAuthenticatedRoleMiddleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RedirectUnauthorizedUser;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->web(append: [
            HandleInertiaRequests::class,
            HandleCors::class,
        ]);

        /* Created Middlewares */
        $middleware->alias([
            'apiKey' => ExternalApiKeyMiddleware::class,
            'role' => CheckAuthenticatedRoleMiddleware::class,
            'redirUnauthUser' => RedirectUnauthorizedUser::class,
            'intApiKey' => InternalApiKeyMiddleware::class,
        ]);


        /* This changes default guest redirection */
        $middleware->redirectGuestsTo(fn (Request $request) => route('login.create'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
