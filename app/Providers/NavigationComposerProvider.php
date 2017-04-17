<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NavigationComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            [
                'menu.navbars',
            ],
            'App\Http\ViewComposer\NavigationComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
