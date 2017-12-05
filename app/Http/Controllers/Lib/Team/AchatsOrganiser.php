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
    /**
     * @var \App\Achat
     */
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
        return $this->achat->acheteurs($team)->toArray();
        die();
    }
}