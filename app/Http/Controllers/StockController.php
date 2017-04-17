<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Locator\LocatorManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class StockController extends Controller
{

    /**
     * StockController constructor.
     */
    public function __construct(LocatorManager $manager)
    {
        $this->manager = $manager;
        $this->keySession = 'locator_search_'.Auth::id();
        $this->keyRedis = 'locator_query_filtred_'.Auth::id();
        $this->keyEmplacement = 'locator_preference_'.Auth::id();
    }

    public function show($id)
    {
        session()->forget($this->keySession);
        Redis::ZINCRBY($this->keyEmplacement,1,$id);
        $articles = $this->manager->searchEmplacement($id)->get();

        return view('locator.show')
            ->with('articles', $articles)
            ->with('nameFilter', strtoupper($id))
            ->with('id', $id);

    }
}
