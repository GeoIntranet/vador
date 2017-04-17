<?php

namespace App\Http\ViewComposer;

use App\Http\Controllers\Lib\Gestion;
use Illuminate\View\View;
use Carbon\Carbon;

class StatComposer extends Gestion
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view   -> with('calender',$this->getCalender())
                -> with('userGlobal',$this->getUsers())
                -> with('tech',$this->getTechnicienUser())
                -> with('now',Carbon::now())
        ;
    }
}