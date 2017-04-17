<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
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
                'stat.menu',
                'stat.menu.menuSent',
                'stat.raccourcit.raccourcitSent',
                'stat.raccourcit.raccourcitGeneral',
                'stat.general',
                'stat.tech.commandAll',
                'stat.tech.commandUser',
                'stat.tech.incidentAll',
                'stat.tech.incidentUser',
                'stat.famille.famille',
                'stat.famille.familleShow',
                'stat.sent.sent_index',
                'stat.sent.show',
                'incident.incidentView',
            ],
            'App\Http\ViewComposer\StatComposer'
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
