<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/12/2016
 * Time: 22:35
 */

namespace App\Http\Controllers\Lib;


use App\Commande;

class proto
{
    /**
     * @var Gestion
     */
    private $gestion;
    /**
     * @var Commande
     */
    private $commande;

    /**
     * proto constructor.
     */
    public function __construct(Gestion $gestion, Commande $commande)
    {
        $this->gestion = $gestion;
        $this->commande = $commande;
    }
}