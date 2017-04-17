<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:31
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class Preparateur
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

        $this->execute();
    }

    public function execute()
    {
        // logique a definir ... .resulte array - nom - pronom - id
        $this->data = $this->orderGestion->gestion->getUserDetails($this->delaisItem->id_preparateur);

        return $this->data;
    }
}