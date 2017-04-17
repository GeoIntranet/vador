<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 29/01/2017
 * Time: 23:10
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Stock;
use Illuminate\Support\Facades\Redis;

class ArriveModule extends Module
{

    public $stock;
    public $module;
    public $name;

    /**
     * ArriveModule constructor.
     */
    public function __construct(Stock $stock)
    {
        parent::__construct();

        $this->stock = $stock;
        $this->module = [];
        $this->name = 'mArrive';
    }

    public function handle()
    {
        $this->logic();

        return $this->module;
    }

    public function logic()
    {
        $key = 'arrive.last';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->stock->LastArrive();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        $this->toFit($data);
    }

    /**
     * @param $lastArrive
     */
    private function toFit($data)
    {
        foreach ($data as $k => $v) {
            $this->module[] =
                [
                    'id' => $v->id_locator,
                    'titre' => substr($v->article, 0, 16),
                    'designation' => substr($v->short_desc, 0, 25),
                    'designation_' => substr($v->long_desc, 0, 25),
                    'type' => $v->art_type,
                    'marque' => $v->art_marque,
                    'dt' => $v->in_datetime,
                ];
        }
    }
}