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
        $this->achats =  $this->achat->acheteurs($team)->with('po')->get();
        $achats_=[];
        foreach ($this->achats as $index => $achats) {
            $achats_[$achats->in_etat][$achats->id_pd]=$achats;
        }
        var_dump($this->achats->pluck('id_pd'));

    }
}