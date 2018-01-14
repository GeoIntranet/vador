<?php

namespace App\Http\Controllers;

use App\Delais;
use App\Http\Controllers\Lib\Calender\CalenderGestion;
use App\Http\Controllers\Lib\Calender\WeekGestion;
use App\Http\Controllers\Lib\Team\TeamOrganiser;
use App\Incident;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeamController extends Controller
{
    /**
     * test prototype en cours
     * @param \App\Http\Controllers\Lib\Team\TeamOrganiser $teamOrganiser
     * @return $this
     */
    public function index(TeamOrganiser $teamOrganiser)
    {
        $team = [ 48, 51, 56 ];

        $work = $teamOrganiser->setTeam($team) ;

        $incidents = $work->getIncidents();

        $achats = $work->getAchats();

        //var_dump($achats);

        /**
         * Trier les incidents en 2 catégorie,
         * Ceux que tu peux gerer :
         *      - Appel dossier
         *      - A rappeler
         *      - Retour matos neuf
         *      - Expedition machine
         *      - Attente audit
         *
         * Ceux que tu ne peut pas gerer:
         *      - Attente info / materiel client
         *      - Attente fournisseur
         */
        // INCIDENT + state + client + date + titre
        // DA en cours  + state + date
        // COMMANDE  -> trie préalables pistolet
        // DELAIS

        return view('team.index')
            ->with('achats',$achats)
            ->with('incidents',$incidents)
            ;

    }

    public function works($date=null)
    {
        $users =[48 => 'gv' , 51 => 'cc', 52 => 'flm' , 78 => 'jfl'];
        $calendar = new WeekGestion();

        if($date <> null) $calendar->setStarterDate($date);

        $calendar = $calendar->generateWeek();

        $week = $calendar->getWeek();

        $delaisItem = New Delais();

        $delaisItem = $delaisItem
            ->whereBetween('date',[$calendar->firstDay(),$calendar->lastDay()])
            ->get()
            ->groupBy('date')
        ;
        return view('team.work')
            ->with('week',$calendar)
            ->with('delais',$delaisItem)
            ->with('users',$users)
            ;


    }

    public function dayAdd($bl)
    {
        $delais = Delais::find($bl) ;
        $date = new carbon($delais->date);
        $date = $date->dayOfWeek == 5 ? $date->addDays(3) : $date->addDay(1);
        $delais->update(['date' => $date]);
        return back();
    }

    public function daySub($bl)
    {
        $delais = Delais::find($bl) ;
        $date = new carbon($delais->date);
        $date = $date->dayOfWeek == 1 ? $date->subDays(3) : $date->subDay(1);
        $delais->update(['date' => $date]);
        return back();

    }
}
