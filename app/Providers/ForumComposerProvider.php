<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ForumComposerProvider extends ServiceProvider
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
                'forum.index',
                'forum.thread.create',
                'forum.thread.show',
                'forum.thread.edit',
                'forum.channel.create',
            ],
            'App\Http\ViewComposer\ForumViewComposer'
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
