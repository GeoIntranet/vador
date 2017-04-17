<?php
namespace App\Http\Controllers\Lib\Commande;
use App\Http\Controllers\Lib\WorkWith;
use App\LigneCommande;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 05/12/2016
 * Time: 21:22
 */
class WorkWithCommandeLigne extends WorkWith
{
   
    private $commandeListe;
    private $ligneCommande;
    private $cleanData;
    public  $resultCommandeLigne;
    public $option;
    public $tasks;

    CONST DELAIS_OPTION = 'delais';

    /**
     * ArticleGestion constructor.
     */
    public function __construct($commandeListe=null,LigneCommande $ligneCommande= null)
    {

        $this->commandeListe = $commandeListe;
        $this->ligneCommande = $ligneCommande;
        $this->resultCommandeLigne = [];
        $this->tasks=[
            'getCommandeLigne',
            'render',
            'clean'
        ];

        $this->option = self::DELAIS_OPTION;
    }

    /**
     * @param $cmd
     * @return $this
     */
    public function setCommande($cmd)
    {
        $this->commandeListe = $cmd;
        $this->ligneCommande = new LigneCommande();

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag()
    {
        $this->tasks = [
            'getCommandeLigne',
            'getTag',
            'render',
        ];

        return $this;
    }

    public function getTag()
    {
        $tags = (new WorkwithTag($this->resultCommandeLigne))->handle();
        $this->tags = $tags->mapCmdToType;
        $this->tagsMap = $tags->mapTypeToCmd;

        return $this;
    }

    public function handle()
    {
        foreach ($this->tasks as $index => $task)
        {
            $this->$task();
        }

        $this->clean();
        $this->lignes = $this->result;
        unset($this->result);

        return $this;
    }


    public function setOption($option)
    {
        if($option==self::DELAIS_OPTION) $this->option = self::DELAIS_OPTION;

        return $this;
    }
    private function getCommandeLigne()
    {
        switch ($this->option)
        {
            case self::DELAIS_OPTION:
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

       if( ! isset($execption[$ligne['type_article']]))
       {
           return $ligne ;
       }
    }

    public function render()
    {
        $this->result=[];

        foreach ($this->resultCommandeLigne->toArray() as $index => $ligne)
        {
            if($this->noExeception($ligne))
            {
                if($this->option == self::DELAIS_OPTION)
                {
                    $mode = self::RENDER_COMMANDE_LiGNE_DELAIS;

                    $this->result[$ligne['id_cmd']][] = (new $mode($ligne))->handle();
                }
            }
        }

        return $this;
    }

    public function clean()
    {
        unset($this->commandeListe);
        unset($this->ligneCommande);
        unset($this->cleanData);
        unset($this->option);
        unset($this->tasks);
        unset($this->in);
        unset($this->mode);
        unset($this->type);
        unset($this->out);
        unset($this->error);
        unset($this->resultCommandeLigne);
    }

}