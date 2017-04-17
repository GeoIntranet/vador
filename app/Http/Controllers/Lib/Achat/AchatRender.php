<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/12/2016
 * Time: 09:34
 */

namespace App\Http\Controllers\Lib\Achat;


use App\Http\Controllers\Lib\Render;

class AchatRender extends Render
{


    public $inAchat;
    public $inActions;
    public $inPo;
    public $gestion;

    public $id;
    public $etat;
    public $reference;
    public $description;
    public $forCommande;
    public $user;
    public $qte_d;
    public $qte_c;
    public $qte_r;
    public $po;
    public $fournisseur;
    public $arrive;

    /**
     * AchatRender constructor.
     * @param $inAchat
     * @param $inActions
     * @param $inPo
     */
    public function __construct($inAchat, $inActions, $inPo,$gestion)
    {
        parent::__construct($gestion);

        $this->inAchat = $inAchat;
        $this->inActions = $inActions;
        $this->inPo = $inPo;

        $this->setAttr();
    }

    public function setAttr()
    {
        $this->id = $this->inAchat->id_pd;
        $this->reference = $this->inAchat->ref;
        $this->description = $this->inAchat->description;
        $this->forCommande = $this->inAchat->id_cmd;
        $this->user = $this->inAchat->crea_id_user;
        $this->qte_d = $this->inAchat->qte_dem == null ? '' : $this->inAchat->qte_dem;
        $this->qte_c = $this->inAchat->qte_cmd == null ? '' : $this->inAchat->qte_cmd;
        $this->qte_r = $this->inAchat->qte_recu == null ? '' : $this->inAchat->qte_recu;
        $this->etat = $this->inAchat->in_etat;
        
        $this->setPoInformation();

        return $this;
    }

    public function setPoInformation()
    {
        if($this->hasPo())
        {
            $this->po = $this->inPo->po_id;
            $this->fournisseur = $this->inPo->pos_nom == null ? '' : $this->inPo->pos_nom;
            $this->arrive = $this->inPo->po_dt_prev_arr == null ? '' : $this->inPo->po_dt_prev_arr;
        }
        else
            {
            $this->po = '';
            $this->fournisseur = '';
            $this->arrive = '';
        }
    }

    public function hasPo()
    {
        return ($this->inPo <> '');
    }

    public function cleanObject()
    {
        unset($this->inPo);
        unset($this->inAchat);
        unset($this->inActions);
        unset($this->gestion);

    }

}