<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Container as Container;

class LocatorRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Http\Lib\LocatorRepositoryInterface', function($app)
        {
            return new Container();
        });
    }
}
