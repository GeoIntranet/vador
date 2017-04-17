<?php

namespace App\Providers;

use App\Container;
use App\Http\Controllers\Lib\Locator\LocatorGenerator;
use Illuminate\Support\ServiceProvider;

class LocatorServiceProvider extends ServiceProvider
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
        
        $this->app->bind('App\Http\Controllers\Lib\Locator\LocatorGeneratorInterface', function($app)
        {
            return new LocatorGenerator(new Container);

        });
    }
}
