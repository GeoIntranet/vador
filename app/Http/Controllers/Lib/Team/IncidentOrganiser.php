<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 05/12/2017
 * Time: 12:58
 */

namespace App\Http\Controllers\Lib\Team;

use App\Incident;

class IncidentOrganiser
{
    public $inc;

    public $search;

    public $notSolvable;

    public $solvable;

    public function getIncidents($team)
    {
        $incident_priority = collect([1,2,4,5,6,7]);
        $incident_not_priority = collect([3,8]);

        $this->inc = Incident::actifs($team)
            ->orderby('open','asc')
            ->get()
            ->groupBy('id_incid');


        foreach ($this->inc as $index => $incident)
        {
            $incident = collect($incident)->first();
            $this->search['description'][$incident->titre]=$incident->id_incid;
            $this->search['client'][$incident->nsoc]=$incident->id_incid;
            $this->search['bl'][$incident->id_cmd]=$incident->id_incid;

            if($incident_priority->search($incident->id_etat) !== false)
            {
                $this->solvable[$incident->id_garant][$incident->id_incid]=
                    [
                        'inc' => $incident->id_incid,
                        'nsoc' => $incident->nsoc,
                        'id_cmd' => $incident->id_cmd,
                        'open' => $incident->open,
                        'lastact' => $incident->lastact,
                        'id_etat' => $incident->id_etat,
                        'id_tech' => $incident->id_tech,
                        'id_garant' => isset($incident->id_garant) ? $incident->id_garant : null,
                    ];
            }
            else{
                $this->notSolvable[]=
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

        return $this;
    }

}