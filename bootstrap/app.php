<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Middleware\CheckAuthenticatedRoleMiddleware;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        /* Created Middlewares */
        $middleware->alias([
            'apiKey' => ApiKeyMiddleware::class,
            'role' => CheckAuthenticatedRoleMiddleware::class,
            'redirectIfAuth' => RedirectIfAuthenticated::class,
        ]);


        /* This changes default guest redirection */
        $middleware->redirectGuestsTo(fn (Request $request) => route('login.create'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
