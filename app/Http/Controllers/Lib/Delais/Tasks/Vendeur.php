<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:30
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class Vendeur
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
        $user = $this->orderGestion->gestion->getUserDetails($this->delaisItem->id_vendeur);

        if( !  isset($user['unknow']) )
        {
            $formateName = substr($user['prenom'],0,1).'.'.$user['nom'];
        }else{
            $formateName = 'Inconnu ( '.$user['id'].' )';
        }

        $this->data = $formateName;

        return $this->data;
    }
}