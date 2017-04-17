<?php

namespace App\Console\Commands\Board;

use App\Http\Controllers\Lib\Board\Module\AchatModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class AchatCache extends Command
{
    public $achat;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:achat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AchatModule $achat)
    {
        parent::__construct();

        $this->achat = $achat;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->deleteKeys();

        $lastAction = $this->achat->getLastAction();

        $dtAction_ = $lastAction->pluck('id_pd');
        $mapAction = $lastAction->pluck('dt_pd_action','id_pd');

        $daToSearch = collect($dtAction_)->flip()->flip()->toArray();

        $listDa = $this->achat->listeAchat($daToSearch);

        $ref=[];

        foreach ($listDa as $k => $v)
        {
            $ref[]=$v->ref;
        }

        //On recupere les information des articles de la liste de DA dans le tableau
        $articles = $this->achat->listeArticle($ref);

    }

    private function deleteKeys()
    {
        $keys = [
            'board.article.list',
            'board.da.list',
            'board.action.actif',
        ];

        foreach ($keys as $key)
        {
            $inc = Redis::get($key);
            if ($inc <> null ) Redis::del($key);
        }

    }
}
