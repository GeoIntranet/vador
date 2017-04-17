<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 20/12/2016
 * Time: 12:53
 */

namespace App\Http\Controllers\Lib\Order;


use App\Http\Controllers\Lib\Gestion;
use Carbon\Carbon;

class DisplayOrder extends Gestion
{
    public $orders;
    public $displayAttribute;

    public $cmd;
    public $bl;
    public $client;
    public $vendeur;
    public $dateCommande;
    public $commandeLignes;

    public $dateDelais;
    public $achat;
    public $tag;
    public $lignes;

    CONST MIN_YEAR ='minWithYear';


    /**
     * DisplayOrder constructor.
     * @param $order
     */
    public function __construct()
    {
        $this->displayAttribute=collect([
            'clients',
            'arrayKeyCmd',
            'arrayKeyClient',
            'arrayAchat',
            'arrayAchatAction',
            'arrayPo',
            'commandes',
            'arrayCommandeLigne',
        ])->flip();

        $this->cmd = 0;
        $this->bl = 0;
        $this->client = 0;
        $this->vendeur = 0;

        $this->achat = FALSE;
        $this->tag = FALSE;
        $this->dateDelais = FALSE;

        $this->commandeLignes = collect([]);

        $this->orders = collect([]);
    }

    public function setManager($orders)
    {

        $this->orders = $orders;

        $this->tag = $orders->withTag;
        $this->achat = $orders->withAchat;
        $this->commandeLignes = $orders->withCommandeLigne;

        return $this;
    }

    public function setCommande($cmd)
    {

        $this->bl = $cmd['id_cmd'];
        $this->cmd = $cmd;


        return $this;
    }

    public function render()
    {
        if( ! $this->orders->errorNoCommand )
        {
            $this->displayLignes();
            $this->client = $this->displayClient();
            $this->lignes = $this->orders->arrayCommandeLigne;
            $this->vendeur = $this->displayVendeur();
            $this->dateCommande = $this->displayDate();
            $this->cleanObject();

            return $this;
        }

        return 'Il n\'ya aucune commande a affichées';
    }

    private function displayClient()
    {
        $id_client = $this->orders->arrayKeyClient[$this->bl];
        return  isset($this->orders->clients[$id_client]) ? $this->orders->clients[$id_client] :'Inconnu '.$id_client ;
    }

    private function displayVendeur()
    {
        $id = $this->orders->arrayKeyUsers[$this->bl];

        if(isset($this->orders->users[$id]))
        {
            $prenom = $this->orders->users[$id]['prenom'];
            $user = substr($prenom,0,1).'.'.$this->orders->users[$id]['nom'];
            return $user;

        }
        return 'inconnu - '.$id;
    }

    private function displayDate()
    {
        $dt = new Carbon($this->cmd['date_cmd']);
        return $this->dateLisible($dt,self::MIN_YEAR) ;
    }

    private function displayLignes()
    {


        if($this->commandeLignes == TRUE)
        {
            $existLigne = isset($this->orders->arrayCommandeLigne[$this->bl]);
            $this->commandeLignes = [];

            if($this->orders->withCommandeLigne == TRUE and $existLigne )
            {
                $lignes = $this->orders->arrayCommandeLigne[$this->bl];
                foreach ($lignes as $index => $ligne)
                {

                    $this->commandeLignes[]= $ligne['qte_cmd'] .' x '. $ligne['code_article'].' '.substr($ligne['desc_article'],0,20);
                }
            }
        }
    }

    private function displayTags()
    {
        return TRUE;
    }

    private function displayAchats()
    {
        return TRUE;
    }

    private function cleanObject()
    {
        $this->cleanGestionObject();
        unset($this->displayAttribute);
        unset($this->cmd);
        unset($this->arrayKeyUsers);
        unset($this->users);
        unset($this->commandes);
        unset($this->lignes);
        //unset($this->commandeLigneGestion);
        unset($this->arrayCommandeLigne);
        unset($this->arrayKeyClient);
        unset($this->orders);
    }


}