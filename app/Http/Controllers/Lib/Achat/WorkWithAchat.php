<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 26/12/2016
 * Time: 11:54
 */

namespace App\Http\Controllers\Lib\Achat;


use App\Achat;
use App\AchatAction;
use App\Http\Controllers\Lib\Gestion;
use App\Http\Controllers\Lib\WorkWith;
use App\Order;

class WorkWithAchat extends WorkWith
{
    public $achat;
    public $po;
    public $action;
    public $gestion;

    public $emptyQueryResult;
    public $renderMode;

    public $arrayAchat;
    public $arrayPo;
    public $arrayAchatToPo;
    public $arrayAchatToAction;
    public $queryResult;
    public $achatByCommand;
    public $achatById;
    public $poById;
    public $actions;
    public $mapCmdToPd;

    public $achatRender;

    public function __construct(Achat $achat, AchatAction $achatAction, Order $po )
    {
        $this->achat = $achat;
        $this->po = $po;
        $this->action = $achatAction;

        $this->renderMode = self::RENDER_GENERAL;

        $this->in = [];
        $this->out = collect([]);

    }

    /**
     * fonction qui execute l'ensemble de la logique
     */
    public function handle()
    {
        $data = $this  ->autoDetect();

        if( ! is_string($data))
        {
            $data
                ->transform()
                ->search()
                ->utilities()
                ->toFit()
                ->searchActions()
                ->searchPo()
            ;
        }


        return $this ;

    }
    /**
     * on initialise le mode DE RENDU .
     * adapter pour les delais.
     * @return $this
     */
    public function ForDelais()
    {
        $this->renderMode = self::RENDER_ACHAT_DELAIS;
        return $this;
    }

    /**
     * requette effectuer en fonction du mode.
     * clef id_pd ( forme DA )
     * clef id_cmd ( from BL )
     * test si resultat de requette vide
     * @return $this
     */
    private function search()
    {
        if($this->mode == self::BL_MODE)
            $this->queryResult = $this->achat->searchFromBl($this->out);
        if($this->mode == self::DA_MODE)
            $this->queryResult = $this->achat->searchFromDa($this->out);

        $this->emptyQueryResult = $this->queryResult->isEmpty() ? TRUE : FALSE;

        return $this;
    }

    /**
     * fonction utilitaire
     * recherche un table avec clef des DA
     * recherche un tableau avec clef des PO
     * recherce un tableau avec un tableau de clef DA -> PO
     * @return $this
     */
    private function utilities()
    {
        if ( ! $this->emptyQueryResult)
        {
            $this->arrayAchat=$this->queryResult->pluck('id_pd')->flip()->flip();
            $this->arrayPo=$this->queryResult->pluck('id_po');
            $this->arrayAchatToPo=$this->queryResult->pluck('id_po','id_pd');
        }

        return $this;
    }

    /**
     * recherche des actions + mise en forme
     * @return $this
     */
    private function searchActions()
    {
        $this->actions = $this->action->searchActionInList($this->arrayAchat);

        if(! $this->actions->isEmpty())
            foreach ($this->actions as $index => $item)
            {
                $this->arrayAchatToAction[$item->id_pd][]=$item;
            }
            unset($this->actions);
            $this->actions=$this->arrayAchatToAction;

        return $this;
    }

    /**
     * recherche des po + mise en forme
     * @return $this
     */
    private function searchPo()
    {
        $this->poInformation = $this->po->SearchPoInformation($this->arrayPo);

        if( ! $this->poInformation->isEmpty())
        {
            foreach ($this->poInformation as $index => $item) {
                $this->poById[$item->po_id]=$item;
            }
        }

        return $this;
    }

    /**
     * mise en forme
     * tableau de DA avec comme clef LE BL
     * tableau DA avec comme clef le numero de DA
     *
     * @return $this
     */
    private function toFit()
    {
        $this->achatById=[];
        if( ! $this->emptyQueryResult )
        {
            foreach ($this->queryResult as $index => $item)
            {
                $this->achatByCommand[$item->id_cmd][$item->id_pd]=$item;

                $this->achatById[$item->id_pd]=$item;

                $this->mapCmdToPd[$item->id_cmd][$item->id_pd]= $item->id_pd;
            }
        }

        return $this;
    }

    /**
     * fonction de rendu .
     * on boucle sur le tableau des achat , et on retourne pour CHAQUE achat , un object de RENDU
     * @return mixed
     */
    public function render()
    {
        $this->renderView =[];

        $this->gestion = $this->gestion == null ? new Gestion() : $this->gestion;

        if(! empty($this->achatById))
        {
            foreach ($this->achatById as $index => $achat)
            {
                $id = $achat->id_pd;

                $render =  new $this->renderMode(
                    $achat,
                    $this->getActionArgument($id),
                    $this->getPoArgument($id),
                    $this->gestion
                );

                $render->render() ;

                $this->achatRender[$achat->id_pd] = $render;
            }
        }
        $this->clean();

        return $this;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getActionArgument($id)
    {
        $action = null;

        if (isset($this->actions[$id])) $action = $this->actions[$id];

        return $action;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getPoArgument($id)
    {
        $po = null;

        if (isset($this->arrayAchatToPo[$id]) AND $this->arrayAchatToPo[$id] <> null)
        {
            $po = $this->poById[$this->arrayAchatToPo[$id]];
        }

        return $po;
    }

    /**
     * fonction pour nettoyer l'object final.
     * @return $this
     */
    private function clean()
    {
        unset($this->achat);
        unset($this->po);
        unset($this->action);
        unset($this->queryResult);
        unset($this->poInformation);
        unset($this->arrayAchatToAction);
        unset($this->arrayAchat);
        unset($this->arrayPo);
        unset($this->arrayAchatToPo);
        unset($this->emptyQueryResult);
        unset($this->in);
        unset($this->out);
        unset( $this->gestion );
        unset( $this->renderMode );
        unset( $this->achatByCommand );
        unset( $this->poById );
        unset( $this->mode );
        unset( $this->type );
        unset( $this->error );
        unset( $this->renderView );
        unset( $this->achatById );
        unset( $this->actions );
        return $this;
    }

}