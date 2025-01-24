<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        // if (config('app.env') == 'production') {
            // $url->forceScheme('https');
            // $this->app['request']->server->set('HTTPS','on');
        // }

        Inertia::share(['errors' => function () {
            return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) []; }]);

    }
}
