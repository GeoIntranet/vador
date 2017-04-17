<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/02/2017
 * Time: 21:53
 */

namespace App\Http\Controllers\Lib\Board\Module;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;


class Module
{
    /**
     * @var Redis
     */

    public $user;


    /**
     * Module constructor.
     */
    public function __construct()
    {
        $this->registerUser();
    }

    public function setUser($id)
    {
        $this->user = $id;
    }
    public function maintenance()
    {
    }

    public function delete($key)
    {
        Redis::del($key);
    }

    public function cacheLogic( $key , $function , $object , $arg = null )
    {
        $cache = Redis::get($key);

        if( ! $cache)
        {
            if($arg)
            {
                $data = $object->$function($arg);
            }
            else{
                $data = $object->$function();
            }

            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }

    private function isLog()
    {

        return isset(Auth::user()->id);
    }

    private function registerUser()
    {
        $isLog = $this->isLog();

        $this->user = $isLog == true ? Auth::user()->id : 48;
    }
}