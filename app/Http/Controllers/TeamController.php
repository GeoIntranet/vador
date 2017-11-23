<?php

namespace App\Http\Controllers;

use App\Incident;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeamController extends Controller
{
    public function index()
    {
        // GV + FLM + CC
        $team = [ 48, 51, 56 ];
        $inc = Incident::actifs($team)->get() ;


        foreach ($inc as $index => $incident)
        {
            $incidents[]=
                [
                    'inc' => $incident->id_incid,
                    'nsoc' => $incident->nsoc,
                    'id_cmd' => $incident->id_cmd,
                    'open' => $incident->open,
                    'lastact' => $incident->lastact,
                    'id_etat' => $incident->id_etat,
                    'id_tech' => $incident->id_tech,
                    'id_garant' => $incident->id_garant,
                ];
        }
        var_dump($incidents);
        // INCIDENT + state + client + date + titre
        // COMMANDE  -> trie préalable pistolet
        // DA en cours  + state + date
        // DELAIS

        var_dump('Team works');
    }
}
