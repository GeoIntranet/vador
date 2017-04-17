<?php
namespace App\Http\Controllers\Lib\Order;


use App\Client;
use App\Commande;
use App\Http\Controllers\Lib\Gestion;

class OrderGestion extends Gestion
{

    public $orderDisplayObject;
    public $manager;

    /**
     * OrderGestion constructor.
     */
    public function __construct(ManageOrder $manager, DisplayOrder $display)
    {
        $this->manager = $manager;
        $this->display = $display;
        $this->manager->simple = TRUE;


    }

    /**
     * recherche une commande en fonction de l'argument .
     * argument accepter : current ( en cours ) - un bl - un model eloquent de commande
     * @param $order
     * @return $this|OrderGestion
     */
    public function searchOrder($order)
    {


        /*Recherche des commandes en cours :collection */
        if( $order == 'current' )
        {
            return $this->currentOrder();
        }

        /*recherche commande specific (int) : collection*/
        if( ( ! is_object($order) ) AND ( $order !== null ) )
        {
            return $this->uniqueOrder($order);
        }

        $this->currentOrder = Commande::uniqueOrder($order->id_cmd);

        return $this;

    }

    public function get()
    {

        $error  = $this->manager->checkData($this->currentOrder);

        if( ! $error)
        {
            $this->currentOrder = $this->manager->getCurrentOrder();

            $this->manager->users = $this->getUsers();

            $this->manager
                ->extractBl()
                ->extractClient()
                ->extractUsers()
                ->searchExtractedClient()
            //->extractCommandLine()
            ;

        }

        return $this;
    }


    /**
     * @return $this
     */
    private function currentOrder()
    {
        $this->currentOrder = Commande::enCours();
        $this->manager->simple = FALSE;
        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    private function uniqueOrder($order)
    {
        $this->currentOrder = Commande::uniqueOrder($order);
        return $this;
    }

    public function withLigneMinimal()
    {
        $this->manager->withCommandeLigne = TRUE;

        $this->manager->withLigneMinimal();
        return $this;
    }

    public function withAchat()
    {
        $this->manager->withAchat = TRUE;

        $this->manager->searchAchats();

        return $this;
    }

    public function withTag()
    {
        $this->manager->withTag = TRUE;
        return $this;
    }

    public function render()
    {
        unset($this->manager->client);

        $render = [];
        //var_dump($this->manager->getOption());



        foreach ($this->manager->commandes as $index => $commande)
        {

            $display = new DisplayOrder();

                if(isset($commande['id_cmd']))
                {
                    $bl = $commande['id_cmd'];

                    $displayObject = $display->setManager($this->manager)->setCommande($commande)->render();

                    $render[$bl ] = $displayObject;
                }
        }

        return $render;
    }




}