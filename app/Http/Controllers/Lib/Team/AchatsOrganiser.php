<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 05/12/2017
 * Time: 13:15
 */

namespace App\Http\Controllers\Lib\Team;

use App\Achat;

class AchatsOrganiser
{
    public $achats;
    private $achat;

    /**
     * AchatsOrganiser constructor.
     */
    public function __construct(Achat $achat)
    {
        $this->achat = $achat;
    }

    public function getAchats($team)
    {
        $this->achats =  $this->achat->with('po')->acheteurs($team)->get();

        $achats_=[];
        foreach ($this->achats as $index => $achats) {

            if($achats->po <> null){
                $achats_['po_index'][$achats->po->po_id]=$achats->id_pd;
                $achats_['po'][$achats->po->po_id]=$achats->po;
            }

            $achats_['state'][$achats->in_etat][$achats->id_pd]=$achats;

            if(is_numeric($achats->id_cmd))
            {
                $achats_['besoin']['bl'][$achats->id_cmd]=$achats->id_pd;
            }
            else{
                $achats_['besoin']['stock'][]=$achats->id_pd;
            }

            $achats_['pd'][$achats->id_pd]=$achats;
        }

        var_dump($achats_);
    }
}