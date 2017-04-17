<?php 
namespace App\Http\Controllers\Lib\Order;

use App\Client;
use App\Commande;
use App\Delais;
use App\Http\Controllers\Lib\Achat\WorkWithDa;
use App\Http\Controllers\Lib\Article\ArticleGestion;
use App\Http\Controllers\Lib\Delais\DelaisGestion;
use App\Http\Controllers\Lib\Delais\ShowDelais;
use App\Http\Controllers\Lib\Gestion;
use App\LigneCommande;
use Carbon\Carbon;

Class OrderGestion_ {

    public $client;
    public $vendeur;
    public $listeOrder;
    public $order;
    public $hasOrder;
    public $noErrors;
    public $currentOrders;

    protected $commandes;
    protected $clients;
    protected $gestion;

    /**
     * @var LigneCommande
     */
    private $commandLigne;

    /**
     * DelaisController constructor.
     */
    public function __construct(Commande $commandes, Client $clients,Gestion $gestion)
    {
        $this->commandes = $commandes;
        $this->clients = $clients;
        $this->gestion = $gestion;

        $this->client = [];
        $this->vendeur = [];
        $this->listeOrder = [];
        $this->da = [];
        $this->hasOrder = FALSE;
        $this->noErrors = TRUE;
    }



    public function hasOrder()
    {
        /* 2 ligne a fusionner peut etre ?  */
        $this->getCurrentOrders = $this->commandes->enCours();
        $this->currentOrders = collect($this->getCurrentOrders->toArray());

        $this->hasOrder = $this->getCurrentOrders->isEmpty() ? FALSE : TRUE ;
        $this->noErrors =  $this->hasOrder ;

        return $this->hasOrder;
    }

    public function ShowOrderWithDelai()
    {
        $this->users = $this->gestion->getUsers();

        $this
            ->extractBl()
            ->extractClient()
            ->extractCommandLine()
        ;

        $this->workWithDelais =
            $this
                ->workWithDelaiGestion()
                ->pullData()
        ;
        return $this;
    }

    public function workWithDelaiGestion()
    {
        return new DelaisGestion(new Delais(),$this);
    }

    public function extractBl()
    {

        if( $this->noErrors ) $this->listeOrder = $this->currentOrders->pluck('id_cmd') ;
        return $this;
    }

    private function extractClient()
    {
        if($this->noErrors)
        {
            $this->deliveredClient = $this->currentOrders->pluck('id_clientlivr');
            $this->client = $this->clients->NameClient($this->deliveredClient);
        }
        return $this;
    }

    public function __get($name)
    {
    	return $this->$name;
    }

    private function extractCommandLine()
    {
        if($this->noErrors)
        {
            $this->commandeLigne = new ArticleGestion($this->listeOrder,new LigneCommande());
            $this->detailLigneCommande = $this->commandeLigne->handle();
        }

        return $this;
    }

    public function existOrder($order)
    {

        $this->currentOrders = $this->commandes->where('id_cmd',$order);

        if( $this->currentOrders )return TRUE ;

        return FALSE;

    }

    public function getNewDelais()
    {
        $this->users = $this->gestion->getUsers();

        $this
            ->extractBl()
            ->extractClient()
            ->extractCommandLine()
        ;

        $this->daInformation = $this
            ->workWithDa()
        ;


        return $this;
    }

    private function workWithDa()
    {

        $this->daObject = app(WorkWithDa::class);

        $cmdToDa = $this->daObject
            ->availablesAchat($this->listeOrder)
            ->pluck('id_pd','id_cmd')
            ->toArray();


        if( ! $this->isEmptyArray($cmdToDa))
        {
            $this->daObject->setDaList($cmdToDa);

            $this->daInformation = $this->daObject->execute();
        }

        return $this;
    }

    private function isEmptyArray($array)
    {
        return empty(array_filter($array, function ($value, $key) {
            return $value != "";
        }, ARRAY_FILTER_USE_BOTH));
    }

}