<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/02/2017
 * Time: 21:36
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Stock;
use Illuminate\Support\Facades\Redis;

class LocatorModule extends Module
{

    public $stock;
    /**
     * LocatorModule constructor.
     */
    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
        parent::__construct();
    }

    public function handle()
    {

        $this->logic();

        return $this->moduleData;
    }

    private function logicEmplacement()
    {
        $favoritLocatorEmplacements = $this->getEmplacement();

        $locatorEmplacement = !empty($favoritLocatorEmplacements[0]) ? $favoritLocatorEmplacements[0] : '';
        $emplacements = explode("_", $locatorEmplacement);
        $this->moduleData['emplacements'] = collect($emplacements);
    }

    private function logicArticle()
    {
        $favoritLocatorMachines = $this->getArticle();
        $locatorMachine = !empty($favoritLocatorMachines[0]) ? $favoritLocatorMachines[0] : '';
        $machines = explode("_", $locatorMachine);
        $this->moduleData['machines'] = collect($machines);
    }

    private function logic()
    {
        $this->logicEmplacement();
        $this->logicArticle();
    }

    /**
     * @return mixed
     */
    public function getEmplacement()
    {
        $key = 'board.preference.emplacement';
        $cache = Redis::get($key);


        return $this->cacheLogic($key,'emplacementFavoris',$this->stock , $this->user);
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        $key = 'board.preference.articles';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->stock->machineFavoris($this->user);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }
        return $data;
    }
}