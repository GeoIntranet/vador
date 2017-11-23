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
        $incidents = Incident::actifs($team);
        var_dump($incidents->get()->toArray());

        // INCIDENT + state + client + date + titre
        // COMMANDE  -> trie préalable pistolet
        // DA en cours  + state + date
        // DELAIS

        var_dump('Team works');
    }
}
