<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\RapidsearchModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RapidSearchCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:rapidsearch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var RapidsearchModule
     */
    public $search;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RapidsearchModule $search)
    {
        parent::__construct();
        $this->search = $search;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$gestion = new Gestion();
        //$this->users = array_keys($gestion->getUsers());
        $this->users=[48];
        $this->DeleteKeys();

        $this->search->actif();
        $this->search->infoDa();
        $this->search->infoCommandeEnCours();

        foreach ($this->users as $index => $user)
        {
            $this->deleteSpecificKeys($user);
            $this->search->setUser($user);

            $this->search->userActif();
            $this->search->nonLu();
            $this->search->infoPrix();

        }

    }

    private function DeleteKeys()
    {
        $keys = [
            'da.encour',
            'commande.encour',
            'incident.all.actif',
        ];

        foreach ($keys as $key)
        {
            $inc = Redis::get($key);
            if ($inc <> null ) Redis::del($key);
        }
    }

    private function deleteSpecificKeys($user)
    {
        $keys = [
            'incident.user.'.$user.'.actif.',
            'dp.'.$user,
            'incident.user.'.$user.'.nonlu.',
        ];
        foreach ($keys as $key)
        {
            $inc = Redis::get($key);
            if ($inc <> null ) Redis::del($key);
        }
    }
}
