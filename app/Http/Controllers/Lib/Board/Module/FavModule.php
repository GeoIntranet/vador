<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/02/2017
 * Time: 18:44
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\FavoriteLink;
use Illuminate\Support\Facades\Redis;

class FavModule extends Module
{
    public $favorite;
    /**
     * @var FavoriteLink
     */
    private $favoriteLink;

    /**
     * FavModule constructor.
     */
    public function __construct(FavoriteLink $favoriteLink)
    {
        parent::__construct();

        $this->favoriteLink = $favoriteLink;
        $this->data=[];
        $this->key = 'board.link.' . $this->user;
    }

    public function handle()
    {
        $this->logic();


        return $this->data;
    }

    public function search()
    {

        $cache = Redis::get($this->key);

        if( ! $cache )
        {
            $this->data = $this->favoriteLink->user($this->user)
                ->get()
                ->toArray();

            Redis::set($this->key,serialize($this->data));
        }
        else
        {
            $this->data = unserialize(Redis::get($this->key));
        }

        return $this;
    }

    private function logic()
    {
        $this->search();
    }
}