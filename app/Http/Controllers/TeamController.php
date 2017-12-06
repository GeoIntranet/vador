<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Team\TeamOrganiser;
use App\Incident;
use Illuminate\Http\Request;

use App\Http\Requests;

class TeamController extends Controller
{
    public function index(TeamOrganiser $teamOrganiser)
    {
        $team = [ 48, 51, 56 ];

        $work = $teamOrganiser->setTeam($team) ;

        $incidents = $work->getIncidents();
        $achats = $work->getAchats();

       




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


        var_dump('Team works');
    }
}
