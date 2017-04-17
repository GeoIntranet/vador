<?php


namespace App\Http\Controllers\Lib\Order;

use App\Client;
use App\Commande;
use App\Http\Controllers\Lib\Achat\WorkWithDa;
use App\Http\Controllers\Lib\Article\ArticleGestion;

class ManageOrder
{
    /*autres*/
    public $client;
    public $clients;
    public $currentOrder;

    public $arrayKeyCmd;
    public $arrayKeyClient;
    public $arrayAchat;
    public $arrayAchatAction;
    public $arrayPo;

    public $noErrors;
    public $errorNoCommand;
    public $simple;
    public $withDelais;
    public $withAchat;
    public $withCommandeLigne;

    public $arrayCommandeLigne;

    /*array pivot*/
    public $cmd_achat;
    public $cmd_client;
    public $achat_action;
    public $achat_po;

    CONST MODE_MIN = 'min';

    /**
     * ManageOrder constructor.
     */
    public function __construct(OrderLigneGestion $lignecommande, Client $client,WorkWithDa $achat)
    {
        $this->commandeLigneGestion = $lignecommande;
        $this->client = $client;
        $this->achats = $achat;
        $this->clients = collect([]);

        $this->noErrors = TRUE;
        $this->errorNoCommand = FALSE;
        $this->simple = FALSE;

        $this->withDa = FALSE;

        $this->withTag = FALSE;
        $this->withAchat = FALSE;
        $this->withDelais = FALSE;
        $this->withCommandeLigne = FALSE;

        $this->commandes = collect([]);
    }

    /**
     * @param $order
     * @return bool
     */
    public function checkData($order)
    {
        $this
            ->setOrder($order)
            ->HomogenizedData()
        ;

        $this->existUniqueOrder($order);

        return $this->errorNoCommand;
    }

    /**
     * @return bool|\Illuminate\Support\Collection
     */
    public function HomogenizedData()
    {
        if($this->simple == TRUE)
        {

            if($this->existUniqueOrder($this->currentOrder))
            {
                return $this->setUniqueCommande();
            }
            return $this->errorNoCommand = TRUE;

        }
        else{
            $this->setMultipleCommande();
        }
    }

    /**
     * @param $currentOrder
     * @return bool
     */
    private function existUniqueOrder($currentOrder)
    {
        return $currentOrder == null ? FALSE : TRUE ;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function setUniqueCommande()
    {

        $this->commandes = $this->currentOrder->first()->toArray();

        $this->commandes = collect([$this->commandes]);

        return $this->commandes;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    private function setMultipleCommande()
    {
        $this->commandes = $this->currentOrder->toArray();

        $this->commandes = collect($this->commandes);

        return  $this->commandes ;
    }

    /**
     * @return $this
     */
    public function setSimpleCmd()
    {
        $this->commandes = collect([$this->commandes->toArray()]);

        return $this;
    }

    /**
     * @return $this
     */
    public function extractBl()
    {
        $this->arrayKeyCmd = array_column($this->commandes->toArray(),'id_cmd');

        return $this;
    }

    /**
     * @return $this
     */
    public function extractClient()
    {
        $this->arrayKeyClient = $this->currentOrder->pluck('id_clientlivr','id_cmd');

        return $this;
    }

    public function extractUsers()
    {
        $this->arrayKeyUsers = $this->currentOrder->pluck('id_vendeur','id_cmd');

        return $this;
    }

    /**
     * @return $this
     */
    public function searchExtractedClient()
    {
        $this->clients = $this->client->NameClient($this->arrayKeyClient);

        return $this;
    }



    /**
     * @param $order
     * @return $this
     */
    private function setOrder($order)
    {
        $this->currentOrder = $order;

        return $this;
    }

    /**
     * retourne les commandes en cours.
     * @return \Illuminate\Support\Collection
     */
    public function getCurrentOrder()
    {
        return $this->commandes;
    }

    /**
     * ajoute la recherche des details lignes commandes bl.
     * @return $this
     */
    public function withLigneMinimal()
    {
        $this->withCommandeLigne = TRUE;

        $commandeLigne = $this->commandeLigneGestion->setCommande($this->arrayKeyCmd);

        $this->arrayCommandeLigne = $commandeLigne->search(self::MODE_MIN) ;

        return $this;
    }

    /**
     * ajoute recherche des demande d'achats liée au bl .
     * @return $this
     */
    public function searchAchats()
    {
        $this->achats->initFromOrder($this->arrayKeyCmd );
        var_dump($this->arrayKeyCmd );
        //var_dump($this->achats->initDaList($this->arrayKeyCmd)->toOrder());
        return $this;
    }

    /**
     * retourne les options pour recherche specific.
     * @return array
     */
    public function getOption()
    {
        return [
            'detail bl' => $this->withCommandeLigne,
            'detail achats' => $this->withAchat,
            'detail delais' => $this->withDelais,
        ];
    }


}