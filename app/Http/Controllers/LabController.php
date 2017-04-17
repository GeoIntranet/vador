<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Events\SomeEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use lib\debugLib;

class LabController extends Controller 
{

    public function Eventing()
    {
        $users = User::where('id',48);
        var_dump($users->count());
        var_dump(Hash::make('06051988'));

    }

    public function testAuth()
    {
        var_dump(Auth::check());

        $dataKeys = Redis::command('KEYS',['*registerRoute*']);
        $dataValues = Redis::command('mget',$dataKeys);

        //var_dump($dataKeys);
        //var_dump($dataValues);

        

        return "ok ";
    }

    public function debug()
    {
        return debugLib::debugj();
    }

    public function wrap()
    {
        $test = Commande::EnCours()->toArray();

        $wrap = collect($test)->map(function($test){
            return new \App\Http\Controllers\Lib\Object\Commande($test);
        });
        //var_dump($wrap);
        

        foreach ($wrap as $index => $item) {

            var_dump($item->formateDate());
            var_dump($item->id_cmd);
        }

        return 'wrap';
    }
}
