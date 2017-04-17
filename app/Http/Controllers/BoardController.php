<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 29/01/2017
 * Time: 18:04
 */

namespace App\Http\Controllers;


use App\cron;
use App\Http\Controllers\Lib\Board\Module\ArriveModule;
use App\Http\Controllers\Lib\Board\ModuleGestion;
use App\Http\Controllers\Lib\Display\DisplayGestion;
use App\Http\Controllers\Lib\Gestion;
use App\Http\Controllers\Lib\User\TemplateRepository;
use Illuminate\Support\Facades\Redis;

class BoardController extends Gestion
{

    public $userGestion;

    /**
     * BoardController constructor.
     */
    public function __construct(DisplayGestion $displayGestion, TemplateRepository $userGestion)
    {
        $this->display = $displayGestion;
        $this->user = $userGestion->handle();

    }

    public function index()
    {
        /**
         * INFO USER - nom - prenom - avatar - rights - admin  - date du jour
         * INFO menu raccourcit  - incident - retour - DA - fiche en cours -
         * MENU NEW
         * MENU favoris
         *
         */

        $modules = (new ModuleGestion($this->user))->handle();

        return view('template.templateContainer')
            ->with('module',$modules)
            ->with('templateNumber',$this->user->templateNumber)
            ->with('map',$this->user->map)
            ;

    }

}