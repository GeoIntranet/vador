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
        $incident_priority = collect([1,2,4,5,6,7]);
        $incident_not_priority = collect([3,8]);
        $inc = Incident::actifs($team)->orderby('open','asc')->get() ;


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



            if($incident_priority->search($incident->id_etat) !== false)
            {
                $incidentSolvable[]=
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
            else{
                $incidentNotSolvable[]=
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
        }

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
        //var_dump($incidents);
        // INCIDENT + state + client + date + titre
        // COMMANDE  -> trie préalable pistolet
        // DA en cours  + state + date
        // DELAIS

        var_dump($incidentNotSolvable);
        var_dump('Team works');
    }
}
