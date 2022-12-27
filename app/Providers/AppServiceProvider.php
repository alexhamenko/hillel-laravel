<?php

namespace App\Providers;

use App\Services\Geo\GeoServiceInterface;
use App\Services\Geo\IpApiGeoService;
use App\Services\Geo\MaxmindService;
use App\Services\UserAgent\DonatjService;
use App\Services\UserAgent\UserAgentParserInterface;
use App\Services\UserAgent\WhichBrowserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoServiceInterface::class, function () {
            return new MaxmindService();
//            return new IpApiGeoService();
        });

        $this->app->singleton(UserAgentParserInterface::class, function () {
            return new DonatjService();
//            return new WhichBrowserService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        view()->composer('particles.language-switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }
}
