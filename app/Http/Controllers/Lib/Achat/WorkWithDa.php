<?php
namespace App\Http\Controllers\Lib\Achat;
use App\Achat;
use App\AchatAction;
use App\Order;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 06/12/2016
 * Time: 12:54
 */
class WorkWithDa
{

    public $daList;
    public $arrayOrder;
    public $arrayAchat;

    public $po;

    public $achat;
    public $achats;

    public $achatAction;
    public $actions;

    public $pdToCmd;
    public $arrayAction_;
    public $poList;
    public $poList_;
    public $poInformation;
    public $structureFinalData;
    public $arrayBl;

    /**
     * WorkWithDa constructor.
     */
    public function __construct(Achat $achat, AchatAction $achatAction, Order $po )
    {
        $this->daList = [];
        $this->arrayOrder = [];
        $this->arrayAchat = [];
        $this->achat = $achat;
        $this->po = $po;
        $this->achatAction = $achatAction;
    }

    /**
     * @param $list
     */
    public function setDaList($list)
    {
        $this->daList = $list;
    }

    public function initFromOrder($order)
    {
        $this->arrayOrder = is_array($order)  ? $order : array($order);
    }

    public function initDaList($arrayBl)
    {
        $this->achats = $this->achat->select('*')->whereIn('id_cmd',$arrayBl)->get();

        return $this;
    }

    public function toOrder()
    {

        $this
            ->extractDaList()
            ->structureAchats()
            ->searchActions()
            ->structureActions()
            ->searchPo()
            ->structurePo()
            ->structureData()
            ->clean()
        ;

        var_dump($this->arrayAchat);


        return $this->structureFinalData;
    }

    private function extractDaList()
    {
        $this->arrayAchat = $this->achats->pluck('id_pd');
        return $this;
    }

    /**
     * @return $this
     */
    public function execute()
    {
        $this
            ->extractDa()
            ->searchAchats()
            ->structureAchats()
            ->searchActions()
            ->structureActions()
            ->searchPo()
            ->structurePo()
            ->structureData()
            ->clean()
            ;

        return $this->structureFinalData;
    }

    /**
     * retourne un tableau avec les DA a chercher
     * @return $this
     */
    private function extractDa()
    {
        foreach ($this->daList as $index => $da)
        {
            if($da <> null )
            {
                $da_temporaire = explode('_',$da);

                $this->pdToCmd[$index] = array_fill_keys (collect($da_temporaire)->flip()->keys()->toArray(),$index);

                $this->arrayAchat = array_merge($this->arrayAchat,$da_temporaire);
            }
        }

        $this->arrayAchat = collect($this->arrayAchat)->flip()->flip();


        return $this;
    }
    /**
     * cherche les achats en fonction de la liste
     * @return $this
     */
    private function searchAchats()
    {
        $this->achats  = $this->achat->searchAchatInList($this->arrayAchat);

        return $this;
    }

    /**
     * @return $this
     */
    private function searchActions()
    {
        $this->actions = $this->achatAction->searchActionInList($this->arrayAchat);
        return $this;
    }


    /**
     * retourne un tableau avec LIST PO
     * @return $this
     */
    private function structureAchats()
    {
        /**
         *  collection tableau id_cmd = > id_pd
         * filtre les valeur null , et les doublons
         */
        $this->poList = $this->achats
            ->pluck('id_po')
            ->reject(function ($value, $key) {
                return $value == null;
            })
            ->flip()
            ->flip();

        return $this;
    }


    /**
     * @return $this
     */
    private function searchPo()
    {
        $this->poInformation = $this->po->SearchPoInformation($this->poList);

        return $this;
    }

    /**
     * @return $this
     */
    private function structureData()
    {
        $structureFinalData = [];


        foreach ($this->pdToCmd as $cmd => $da)
        {
            foreach ($da as $da => $cmd)
            {
                $po = $this->achats->where('id_pd',$da)->first();

                $this->structureFinalData[$cmd][$da]['da'] = $this->achats->where('id_pd',$da)->first()->toArray();
                $this->structureFinalData[$cmd][$da]['actions'] =  isset($this->arrayAction_[$da]) ? $this->arrayAction_[$da] : '' ;
                $this->structureFinalData[$cmd][$da]['po'] =  $this->poInformation->where('po_id',$po->id_po)->first();
            }

        }
        return $this;
    }

    /**
     * @return $this
     */
    private function structureActions()
    {


        foreach ($this->actions as $index => $action)
        {
            $arrayActions[$action->id_pd][] = $action->toArray();
        }

        $this->arrayAction_=[];
        foreach ($arrayActions as $index => $arrayAction)
        {
            $this->arrayAction_[$index]=collect($arrayAction);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function structurePo()
    {
        return $this;
    }

    /**
     * @return $this
     */
    private function clean()
    {
        unset ($this->achat);
        unset ($this->achatAction);
        unset ($this->po);

        return $this;
    }

    public function availablesAchat($lisBl)
    {
        $this->arrayBl = $lisBl;

        $this->achats = $this->searchAchatsByCmd();

        return $this->achats;
    }

}