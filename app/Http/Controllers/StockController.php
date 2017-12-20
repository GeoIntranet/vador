<?php

namespace App\Http\Controllers;

use App\Achat;
use App\Http\Controllers\Lib\Locator\LocatorManager;
use App\Stock;
use App\StockMini;
use Carbon\Carbon;
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
        Redis::ZINCRBY($this->keyEmplacement, 1, $id);
        $articles = $this->manager->searchEmplacement($id)->get();

        return view('locator.show')->with('articles', $articles)->with('nameFilter', strtoupper($id))->with('id', $id);
    }

    public function mini(Stock $stock, Achat $achat, StockMini $stockMini)
    {
        $stockMini_ = $stockMini->where('user_id',auth()->id())->get()->groupBy('article');

        $cat =[];

        foreach ($stockMini_ as $index => $stockMini__ )
        {
            $cat[]= $stockMini__->first()->article;
        }

        $now = Carbon::now();
        $begin = $now->copy()->subYear(1)->format('Y-m-d');

        $year = $now->copy()->subYear(1);
        $sixMonth = $now->copy()->subMonths(6);
        $oneMonth = $now->copy()->subMonth(1);



        $sorties = $stock
            ->sortie()
            ->select('id_locator', 'article', 'out_datetime')
            ->whereIn('article', $cat)
            ->whereBetween('out_datetime', [ $begin, $now->format('Y-m-d')])
            ->get()
        ;

        $stocks = $stock
            ->select('id_locator', 'article','id_etat')
            ->with('articleModel')
            ->whereIn('article', $cat)
            ->whereNull('out_datetime')
            ->get()
        ;

        $achats  = $achat->whereIn('ref',$cat)
            ->whereNull('qte_recu')
            ->get();

        $classeurSortie = [];
        $classeurStock = [];
        $classeurAchat = [];

        foreach ($stocks as $index_stock => $id)
        {
            $classeurStock['counter'] = $index_stock + 1;
            $classeurStock['desc'][$id->article] = isset($id->articleModel->short_desc) ? $id->articleModel->short_desc : '';
            $classeurStock[$id->article][$id->id_etat][] = $id->id_locator;
        }

        foreach ($achats as $index_achat => $achat)
        {
            $classeurAchat[$achat->ref][$achat->id_pd][] = $achat->in_etat;
        }


        $yearCount = 1;
        $sixMonthCount = 1;
        $oneMonthCount = 1;

        foreach ($sorties as $index => $sortie) {
            $classeurSortie[$sortie->article]['years'][] = $sortie->out_datetime;

            if ($sortie->out_datetime > $sixMonth) {
                $classeurSortie[$sortie->article]['sixMonth'][] = $sortie->out_datetime;
            }

            if ($sortie->out_datetime > $oneMonth) {
                $classeurSortie[$sortie->article]['oneMonth'][] = $sortie->out_datetime;
            }
        }



       return view('stock.mini')
           ->with('sorties',$classeurSortie)
           ->with('stock',$classeurStock)
           ->with('achats',$classeurAchat)
           ->with('mini',$stockMini_)
           ;
    }
}
