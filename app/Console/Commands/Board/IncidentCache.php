<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\IncidentModule;
use App\Http\Controllers\Lib\Gestion;
use App\Incident;
use Illuminate\Console\Command;
use App\cron;
use Illuminate\Support\Facades\Redis;

class IncidentCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:incident';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    protected $incident;
    protected $users;

    public function __construct(IncidentModule $incident)
    {
        parent::__construct();
        $this->incident = $incident;

    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->users=[48];

        $this->deleteGenericKeys();

         $this->incident->last();
         $this->incident->allActif();

        foreach ($this->users as $index => $user)
        {
            $this->deleteSpecificKeys($user);
            $this->incident->setUser($user);
            $this->incident->actif();
            $this->incident->nonLu();
         }


        $cron = new Cron();
        $cron->CRON_name = 'IncidentCache';
        $cron->save();

    }

    private function deleteGenericKeys()
    {
        $inc = Redis::keys('*incident.all*');
        if($inc) Redis::del($inc);
    }

    private function deleteSpecificKeys($id = null)
    {
        $inc =
            $id == null ?
                Redis::keys('*incident.user.') :  Redis::keys("*incident.user.$id*");
        ;

        if($inc) Redis::del($inc);
    }
}
