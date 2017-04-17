<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 26/01/2017
 * Time: 22:42
 */

namespace App\Http\ViewComposer;
use App\Http\Controllers\Lib\Locator\LocatorCache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class LocatorComposer
{
    public $cache;
    /**
     * LocatorComposer constructor.
     */
    public function __construct(LocatorCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view )
    {
        $query = 'locator_query_filtred_';
        $emplacement = 'locator_preference_'.Auth::id();

            if( !empty(Redis::ZRANGE($emplacement,0,-1))){
                $emplacementPref = collect(Redis::ZREVRANGE($emplacement,0,8));
                $view  -> with('emplacement',$emplacementPref) ;
            }


        if( $this->cache->exist($query) )
        {
            $data = collect($this->cache->get($query))
                ->take(10) ;

            $view  -> with('timelineData',$data) ;
        }

    }
}