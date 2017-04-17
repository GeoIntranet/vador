<?php

namespace App\Http\Controllers;


use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

        class DevelopController extends Controller
        {

            protected $debugbar;
            /**
             * DevelopController constructor.
             */
            public function __construct(LaravelDebugbar $debugbar)
            {
                /*
                 * Desactivation de la debugbar
                 */
                $this->debugbar = $debugbar;
                $this->debugbar->disable();

    }

    public function cssGuide($page = null)
    {

        $view = 'develop.index';

        $view =  View::exists('develop.'.$page) ? 'develop.'.$page : $view;

        return view($view,compact('page'));

   }

    public function whois()
    {
        $horaires = DB::table('horraires')->where('user',48)->orderBy('date_r','DESC')->limit(0)->take(100)->get();
        var_dump($horaires);
   }
}
