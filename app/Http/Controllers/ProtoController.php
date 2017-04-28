<?php

namespace App\Http\Controllers;

use App\Favoris;
use App\Http\Controllers\Lib\Filter\ThreadFilter;
use App\Http\Controllers\Lib\Stat\StatUserGestion;
use App\Thread;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class ProtoController extends Controller
{
    public function autoInjection( )
    {
        dump($_SERVER);
    }

    public function userstat(StatUserGestion $stat)
    {
        dump($stat);
    }

    public function morph()
    {

        //MORPH favoris -> model associer qui est en favoris ( ex un post , un incident , un profil etc ... )

        //$favoris = Favoris::find(1);


        $favoris_ = Favoris::whereIN('id',[1,2])->get();
        foreach ($favoris_ as $index => $favoris) {
            if(isset($favoris->favorited()->first()->body))
                dump($favoris->favorited()->first()->body)
                ;

        }


        // MORPH MODEL -> favoris associer au model.
        //$thread = Thread::find(10)->favoris()->get();
        dump($favoris_);
    }
    
}
