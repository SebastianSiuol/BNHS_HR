<?php

namespace App\Providers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

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
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }


        View::composer('components.admin.layout', function ($view) {
            $view->with('loggedUser', Auth::user());
        });

        View::composer('components.admin.sidebar', function ($view) {
            $view->with('logged_user', Auth::user());
        });

        Paginator::useTailwind();
    }
}
