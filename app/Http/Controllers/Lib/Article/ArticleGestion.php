<?php
namespace App\Http\Controllers\Lib\Article;
use App\LigneCommande;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 05/12/2016
 * Time: 21:22
 */
class ArticleGestion
{
   
    private $commandeListe;
    private $ligneCommande;
    private $cleanData;
    public  $resultCommandeLigne;
    public $option;

    CONST DELAIS = 'delais';

    /**
     * ArticleGestion constructor.
     */
    public function __construct($commandeListe=null,LigneCommande $ligneCommande= null)
    {
        $this->commandeListe = $commandeListe;

        $this->ligneCommande = $ligneCommande;

        $this->resultCommandeLigne = [];
        $this->option =self::DELAIS;
    }

    public function setCommande($cmd)
    {
        $this->commandeListe = $cmd;
        $this->ligneCommande = new LigneCommande();

        return $this;
    }

    public function handle()
    {
        $this
            ->getCommandeLigne()
            ->render()
            ->cleanData()
        ;
        return $this;
    }

    public function setOption($option)
    {
        if($option==self::DELAIS) $this->option = self::DELAIS;

        return $this;
    }
    private function getCommandeLigne()
    {
        switch ($this->option)
        {
            case self::DELAIS:
                $this->resultCommandeLigne = $this->ligneCommande->ligneCommandeDelais($this->commandeListe);
                break;

        }

        return $this;
    }

    private function cleanData()
    {
        foreach ($this->resultCommandeLigne as $index => $ligne) {
            $resultat= $this->delaiRender($ligne);
            if($resultat <> null) $this->result[$ligne->id_cmd][] = $resultat ;
        }

        return $this->result;
    }

    private function delaiRender($ligne)
    {
        if( $this->noExeception($ligne))
        {
            $result = $ligne;

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

    public function render()
    {

        return $this;
    }


}