<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\Inspire::class,
         Commands\Board\IncidentCache::class,
         Commands\Board\ArriveCache::class,
         Commands\Board\InfoCache::class,
         Commands\Board\AchatCache::class,
         Commands\Board\PreferenceCache::class,
         Commands\Board\RapidSearchCache::class,
         Commands\Board\CrmCache::class,
         Commands\Board\FavorisCache::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->everyMinute();
        $schedule->command('board:incident')->everyMinute();
        $schedule->command('board:arrive')->everyMinute();
        $schedule->command('board:info')->everyMinute();
        $schedule->command('board:achat')->everyMinute();
        $schedule->command('board:preference')->everyMinute();
        $schedule->command('board:rapidsearch')->everyMinute();
        $schedule->command('board:crm')->everyMinute();
        $schedule->command('board:favoris')->everyMinute();
    }
}
