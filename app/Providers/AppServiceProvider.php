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
use App\Establishment;
use App\QuickStat;
use Auth;
use App\UpdateUserRequest;

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
                $surigaoDelSurStats     = QuickStat::get();

                $surigaoDelSurStatsChartLabels    = $surigaoDelSurStats->pluck('name')->implode('|');
                $surigaoDelSurStatsChartConfirmed = $surigaoDelSurStats->pluck('confirmed')->implode('|');
                $surigaoDelSurStatsChartRecovered = $surigaoDelSurStats->pluck('recovered')->implode('|');
                $surigaoDelSurStatsChartDeaths    = $surigaoDelSurStats->pluck('deaths')->implode('|');


                $surigaoDelSurConfirmed = $surigaoDelSurStats->sum('confirmed');
                $surigaoDelSurRecovered = $surigaoDelSurStats->sum('recovered');
                $surigaoDelSurDeaths    = $surigaoDelSurStats->sum('deaths');

                $view->with('establishment_by_municipal', Establishment::where('city_code', Auth::user()->city_code)->count());
                $view->with('person_count', Person::count());
                $view->with('municipal_count', Municipal::count());
                $view->with('checker_count', Checker::count());
                $view->with('scanned_qr', PersonLog::count());

                $view->with('confirmed', $surigaoDelSurConfirmed);
                $view->with('recovered', $surigaoDelSurRecovered);
                $view->with('deaths', $surigaoDelSurDeaths);

                $view->with('horizontal_chart_label', $surigaoDelSurStatsChartLabels);
                $view->with('horizontal_chart_confirmed', $surigaoDelSurStatsChartConfirmed);
                $view->with('horizontal_chart_recovered', $surigaoDelSurStatsChartRecovered);
                $view->with('horizontal_chart_deaths', $surigaoDelSurStatsChartDeaths);
            });

            View::composer(['templates-2.app'], function ($view) {
                $view->with('requestUpdate', UpdateUserRequest::with('person:person_id,id,firstname,middlename,lastname,suffix')->get());
            });

        }
    }
}
