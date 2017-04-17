<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 11/01/2017
 * Time: 21:49
 */

namespace App\Http\Controllers\Lib\Commande;


class LigneRenderDelais
{
    public $ligne;

    /**
     * LigneRenderDelais constructor.
     */
    public function __construct($ligne)
    {
        $this->ligne = $ligne;
    }

    public function handle()
    {
        return $this->ligne['qte_cmd'] . ' x ' . $this->ligne['code_article'] .' - '. $this->ligne['desc_article'];
    }
}