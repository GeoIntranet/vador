<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 05/12/2017
 * Time: 13:15
 */

namespace App\Http\Controllers\Lib\Team;

use App\Achat;
use App\Http\Controllers\Lib\Achat\AchatHelper;
use Carbon\Carbon;

class AchatsOrganiser extends AchatHelper
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
        $this->achats['models'] =  $this->achat->with('po','action')->acheteurs($team)->get();

        $achats_=[];

        foreach ($this->achats['models'] as $index => $achats) {

            $this->achats['date'][$achats->id_pd]=
                [
                    'debut' =>  $achats->action->first()->dt_pd_action,
                    'fin' =>  Carbon::now()->format('Y-m-d'),

                ] ;

            $this->achats['dt'][$achats->id_pd]=$achats->action->first()->dt_pd_action ;

            if($achats->po <> null){
                $this->achats['po_index'][$achats->po->po_id]=$achats->id_pd;
                $this->achats['po'][$achats->po->po_id]=$achats->po;
            }

            $this->achats['state'][$achats->in_etat][$achats->id_pd]=$achats;

            if(is_numeric($achats->id_cmd))
            {
                $this->achats['besoin']['bl'][$achats->id_cmd]=$achats->id_pd;
            }
            else{
                $this->achats['besoin']['stock'][]=$achats->id_pd;
            }

            $this->achats['pd'][$achats->id_pd]=$achats;
        }

        return $this;
    }
}