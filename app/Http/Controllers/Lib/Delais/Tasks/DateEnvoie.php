<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:29
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class DateEnvoie
{

    public $data;

    /**
     * FormatClient constructor.
     */
    public function __construct($orderGestion,$delaisItem)
    {
        $this->data = '';
        $this->delaisItem = $delaisItem;
        $this->orderGestion = $orderGestion;
        $this->dateEnvoie = $this->delaisItem->date_envoie;

        $this->execute();
    }

    /**
     * object orderGestion qui contient l'objet gestion
     * on vas recuperer dans l'object DelaisItem la date d'envoie
     * DelaiItem = resultat unique base de donné correspondant a un delais specific via id_cmd
     * grace a la fonction de presentation de date dans l'object gestion
     *
     * @return string
     */
    public function execute()
    {

        $this->data = $this->orderGestion->gestion->dateLisible($this->dateEnvoie,'minWithYear');

        return $this->data;
    }

}