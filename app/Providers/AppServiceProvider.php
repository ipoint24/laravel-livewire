<?php

namespace App\Providers;

use App\Charts\LoginChart;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @param Charts $charts
     * @return void
     */
    public function boot(Charts $charts)
    {
        Carbon::setLocale(config('app.locale'));
        $charts->register([
            LoginChart::class
        ]);
    }
}
