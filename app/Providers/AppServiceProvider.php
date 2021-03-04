<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Person;
use App\PersonLog;
use App\Checker;
use App\Municipal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }

        if (View::exists('admin.dashboard')) {

            View::composer(['admin.dashboard', 'municipal.dashboard'], function ($view) {
                $test = 'testing';

                $view->with('person_count', Person::count());
                $view->with('municipal_count', Municipal::count());
                $view->with('checker_count', Checker::count());
                $view->with('scanned_qr', PersonLog::count());
                $view->with('testing', $test);
            });

        }
    }
}
