<?php

namespace App\Providers;


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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // $isSharedHosting = (bool) env('SHARED_HOSTING');
        // if($isSharedHosting) {
        //     $this->app->bind('path.public', function() {
        //         return realpath(base_path().'/../public_html');
        //     });
        // }
    }
}
