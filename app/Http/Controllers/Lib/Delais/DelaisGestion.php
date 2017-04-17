<?php
namespace App\Http\Controllers\Lib\Delais;

use App\Delais;
use App\Http\Controllers\Lib\Achat\WorkWithDa;

class DelaisGestion
{

    private $commandes;
    private $clients;
    protected $delais;
    protected $showDelais;
    protected $orderDelais;

    protected $currentOrders;
    protected $listOfBls;
    protected $orderDelaiList;
    protected $errors;
    protected $orders;
    protected $listingOrder;
    protected $categorie;
    protected $demandeAchat;
    protected $daInformation;
    public $resultOrder;



    /**
     * DelaisController constructor.
     */
    public function __construct(Delais $delais ,OrderGestion_ $orderGestion )
    {
        $this->orderGestion = $orderGestion;
        $this->delais =$delais;
        $this->commandes = $this->orderGestion->commandes;
        $this->clients =  $this->orderGestion->clients;
        $this->gestion =  $this->orderGestion->gestion;
        $this->categorie = $this->gestion->getCategorieDB();
        $this->noErrors = FALSE;
        $this->resultOrder = FALSE;
        $this->listeDa = [];
        $this->demandeAchat = [];
    }

    /**
     * methode magique getter universelle
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * logique de recuperation des données ,
     * savoir si la commande a eu un delai attribué
     * et recuperer les differente donné du delais .
     * @return DelaisGestion|bool
     */
    public function pullData()
    {
        $this
            ->searchOrderDelais()
            ->checkWaiting()
            ->compactOrderDelais()
            ->workWithDa()
            ->clean()
            ->filterResult()
        ;

        return $this;
    }

    /**
     * Recherche dans la base des  delai en fonction d'une liste de BL
     * @return [type]
     */
    public function searchOrderDelais()
    {
        $this->orderDelais  = $this->delais->searchDelaisIn($this->orderGestion->listeOrder);
        return $this;

    }

    /**
     * Chech si la base de donné delais est pas vide ( context de la liste BL )
     * @return $this
     */
    private function checkWaiting()
    {
        $this->noErrors = $this->orderDelais->isEmpty() ? FALSE : TRUE;
        return $this;
    }

    /**
     * rassemblement des données table Commandes / delais
     */
    private function compactOrderDelais()
    {
        if($this->noErrors)
        {
            $this->orderGestion->getCurrentOrders
                ->map(function($value, $key)
                {
                    $this->dispatchOrder($value,$key);
                });
        }
        return $this;
    }

    /**
     * En fonction de presence delai ou NON ,
     * dispatch data dans table en 2 parties
     * index 1 - withDelais
     * index 2 - withNoDelais
     *
     * @param $value
     * @param $key
     */
    private function dispatchOrder($value, $key)
    {
        $this->orderDelaiList = $this->orderDelais->pluck('id_cmd')->flip();

        if($this->orderDelaiExist($value))
        {
            $this->hydrateDelaiWithDelai($value,$key);
        }
        else
        {
            $this->hydrateDelaiWithNoDelai($value,$key);
        }

    }

    /**
     * fonction de controle pour savoir si dispatch:
     *  dans l'index withDelais
     *  dans l'index withNoDelais
     * @param $value
     * @return bool
     */
    private function orderDelaiExist($value)
    {
        return $this->orderDelaiList->has($value->id_cmd) ? TRUE : FALSE;
    }

    /**
     * fonction pour hydra le tableau
     * @param $value
     * @param $key
     */
    private function hydrateDelaiWithNoDelai($value, $key)
    {

        $this->resultOrder['withNoDelais'][]=[
            'bl' => $value->id_cmd,
            'dt' => '-',
            'id_vendeur' => $value->id_vendeur,
            'vendeur' => $this->gestion->getUserDetails($value->id_vendeur),
            'id_client' => $value->id_clientlivr,
            'client' => $this->orderGestion->client[$value->id_clientlivr],
            'info_prod' => $value->info_prod,
        ];
    }

    /**
     * fonction pour hydrate le tableau
     * @param $value
     * @param $key
     */
    private function hydrateDelaiWithDelai($value, $key)
    {
        /*recherche la ligne dans la DB*/
        $this->item = $this->orderDelais->find($value->id_cmd);

        /*instance object pour presenter les donnée*/
        $showDelais = new ShowDelais($this->orderGestion,$this->item,$value);

        $this->listeDa[$this->item->id_cmd]=$this->item->liste_da;

        /*resultat*/
        $this->resultOrder['withDelais'][]=$showDelais->render();
    }

    private function filterResult()
    {
        $this->resultOrder['withNoDelais'] = collect($this->resultOrder['withNoDelais']);
        $this->resultOrder['withDelais'] =collect($this->resultOrder['withDelais']);
    }

    private function workWithDa()
    {

        if( ! $this->isEmptyArray($this->listeDa))
        {
            $daObject = app(WorkWithDa::class);

            $daObject->setDaList($this->listeDa);

            $this->daInformation = $daObject->execute();
        }

        return $this;
    }

    /**
     * @return bool
     */
    private function isEmptyArray($array)
    {
        return empty(array_filter($array, function ($value, $key) {
            return $value != "";
        }, ARRAY_FILTER_USE_BOTH));
    }


    private function clean()
    {

        unset($this->commandes);
        unset($this->clients);
        unset($this->delais);
        unset($this->showDelais);
        unset($this->currentOrders);
        unset($this->listOfBls);
        unset($this->listingOrder);
        unset($this->categorie);

        return $this;
    }
}