<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Filter\ThreadFilter;
use App\Http\Controllers\Lib\Stat\StatUserGestion;
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
    
}
