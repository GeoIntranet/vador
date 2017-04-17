<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 01/02/2017
 * Time: 22:16
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Achat;
use App\AchatAction;
use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class AchatModule extends Module
{

    public $achat;
    public $action;
    public $data;

    /**
     * AchatModule constructor.
     */
    public function __construct(
        Achat $achat ,
        AchatAction $action ,
        Article $article
    )
    {
        parent::__construct();
        $this->achat = $achat;
        $this->action = $action;
        $this->article = $article;
    }

    public function handle()
    {
        $this->logic();

        return $this->module;
    }

    private function logic()
    {
        $lastAction = $this->getLastAction();

        $dtAction_ = $lastAction->pluck('id_pd');
        $mapAction = $lastAction->pluck('dt_pd_action','id_pd');

        $daToSearch = collect($dtAction_)->flip()->flip()->toArray();

        $listDa = $this->listeAchat($daToSearch);

        $ref=[];

        foreach ($listDa as $k => $v)
        {
            $ref[]=$v->ref;
        }

        //On recupere les information des articles de la liste de DA dans le tableau
        $articles = $this->listeArticle($ref);

        foreach ($listDa as $k => $v)
        {

            $article_ = isset($articles[$v->ref]) ? $articles[$v->ref] : 'Inconnu';

            $this->module[]=[
                'id' =>$v->id_pd,
                'ref' => substr($v->ref,0,5),
                'description' => substr($article_,0,10),
                'tool' =>  $article_,
                'dt' => new Carbon($mapAction[$v->id_pd]),
            ];

        }
    }

    /**
     * @return mixed
     */
    public function getLastAction()
    {
        $key = 'board.action.actif';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->action->last(5);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }

    /**
     * @param $daToSearch
     * @return mixed
     */
    public function listeAchat($daToSearch)
    {
        $key = 'board.da.list';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->achat->ListDa($daToSearch);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }

    /**
     * @param $ref
     * @return mixed
     */
    public function listeArticle($ref)
    {
        $key = 'board.article.list';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data =  $this->article->List($ref);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }
}