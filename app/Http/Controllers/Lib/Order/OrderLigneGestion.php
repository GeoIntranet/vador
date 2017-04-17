<?php
namespace App\Http\Controllers\Lib\Order;

use App\LigneCommande;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 05/12/2016
 * Time: 21:22
 */
class OrderLigneGestion
{

    private $commandeListe;
    private $ligneCommande;
    public $lignes;
    private $cleanData;
    private $resultCommandeLigne;

    CONST MODE_MIN = 'min';
    CONST MODE_EXP = 'exp';

    /**
     * ArticleGestion constructor.
     */
    public function __construct($commandeListe=null,LigneCommande $ligneCommande= null)
    {
        $this->commandeListe = $commandeListe;
        $this->ligneCommande = $ligneCommande;
        $this->resultCommandeLigne = [];
        $this->lignes=[];
        $this->exception=collect([
            'MODT',
            'COMMANDE',
            'DIVERS'
        ])
            ->flip();
    }

    public function setCommande($cmd)
    {
        $this->commandeListe = $cmd;
        $this->ligneCommande = new LigneCommande();

        return $this;
    }

    public function search($mode = self::MODE_MIN)
    {
        if($mode == self::MODE_MIN)
            $this->getCommandeLigneMin()->filtered();

        elseif ($mode == self::MODE_EXP)
            $this ->getCommandeLigneExpended();


        $this->tasks();

        return $this->lignes;
    }

    private function tasks()
    {
        $this->structure()
            ->cleanObject()
        ;
    }

    private function getCommandeLigneMin()
    {
        $this->resultCommandeLigne = $this->ligneCommande->ligneCommandeDelais($this->commandeListe);
        $this->resultCommandeLigne = collect($this->resultCommandeLigne->toArray());
        return $this;
    }

    private function getCommandeLigneExpended()
    {
        $this->resultCommandeLigne = $this->ligneCommande->ligneCommandeDelais($this->commandeListe);
        $this->resultCommandeLigne = collect($this->resultCommandeLigne->toArray());
        return $this;
    }

    public function structure()
    {

        foreach ($this->filtered as $index => $ligne) {
            $this->lignes[$ligne['id_cmd']][]=$ligne;
       }
        return $this;
    }

    private function forDelaisDisplay()
    {
        $filtered = $this->resultCommandeLigne->reject(function ($value, $key) {
            //var_dump($value);
        });

        $filtered->all();
        return $this;
    }

    private function cleanData()
    {
        //foreach ($this->resultCommandeLigne as $index => $ligne) {
        //    $resultat= $this->searchException($ligne);
        //    if($resultat <> null) $this->result[$ligne->id_cmd][] = $resultat ;
        //}
        return $this->result;
    }

    private function searchException($ligne)
    {
        if( $this->noExeception($ligne))
        {
            $result = $ligne->qte_cmd.' x '.$ligne->code_article .' '.$ligne->desc_article;
            return $result;
        }
    }

    private function noExeception($ligne)
    {
        $execption =collect([
            'MODT',
            'COMMANDE',
            'DIVERS'
        ])
            ->flip();

        if( ! isset($execption[$ligne->type_article]))
        {
            return $ligne ;
        }
    }

    private function cleanObject()
    {
        unset($this->ligneCommande);
        unset($this->cleanData);
        unset($this->commandeListe);
    }

    private function filtered()
    {
        $this->filtered = $this->resultCommandeLigne->reject(function ($value, $key) {
            if($this->exception->has($value['type_article'])) return $value;
        });




    }


}