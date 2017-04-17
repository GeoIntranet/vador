<?php
namespace App\Http\Controllers\Lib\Id;
use App\Article;
use App\Keyword;
use App\Stock;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 30/03/2017
 * Time: 14:26
 */
class IdManager
{

    public $idIn;
    public $isHs;
    public $isNew;
    public $whoIn;
    public $whenIn;
    public $isOut;
    public $idOut;
    public $whoOut;
    public $whenOut;
    public $whyOut;
    public $isAudit;
    public $idAudit;
    public $whoAudit;
    public $whenAudit;
    public $emplacements;
    public $constant;


    /**
     * IdManager constructor.
     */
    public function __construct(
        Article $articles,
        Keyword $keyword
    )
    {
        $this->articles = $articles;
        $this->keyword = $keyword;

        $this->etat = [
            '0' =>  'Non audité',
            '1' => 'Neuf' ,
            '11' =>  'Occase / Ret. Demo',
            '21' =>  'A Reconstruire',
            '22' =>  'EPAVE / PIECES / HS',
            '30' =>  'Conso Compatible',
            '40' =>  'Conso Marque',
        ];

        $this->isOut = false;
        $this->isAudit = false;


    }

    public function init(Stock $id)
    {
        $this->id = $id;

        $this
            ->state()
            ->in()
            ->out()
            ->audit()
            ->article()
            ->emplacementAll()
        ;

        return $this;
    }

    /**
     * Test si id est sortie
     * @return bool
     */
    public function isOut()
    {
        return $this->id->out_datetime <> null ? TRUE : FALSE ;
    }

    /**
     * Test si ID est HS
     * @return bool
     */
    public function isHs()
    {
        return $this->id->hs == 1 ? TRUE : FALSE ;
    }

    /**
     * methode qui vas rassembler les info sur celui qui a In stock l'ID
     * @return $this
     */
    public function in()
    {
        $this->whoIn = $this->getInUser();
        $this->whenIn = $this->getInDate();
        $this->idIn = $this->id->in_id_user;

        return $this;
    }

    /**
     * methode qui vas rassembler les info sur celui qui a OUT stock l'ID
     * @return $this
     */
    public function out()
    {
        if($this->isOut())
        {
            $this->isOut = TRUE;
            $this->whoOut = $this->getOutUser();
            $this->whenOut = $this->getOutDate();
            $this->idOut = $this->id->out_id_user;
            $this->whyOut = $this->id->out_id_cmd;
        }
        return $this;
    }

    /**
     * retourne le nom user qui a rentrer l'ID
     * @return string
     */
    private function getInUser()
    {
        return $this->whoIn == null ? userName($this->id->in_id_user) : $this->whoIn;
    }

    /**
     * retourne la date de rentré de stock
     * @return mixed
     */
    private function getInDate()
    {
        return $this->whenIn == null ? $this->format($this->id->in_datetime) : $this->whenIn;
    }

    /**
     * formate date
     * jour / moi / Année
     * heure : minute : seconde
     * @param $date
     * @return mixed
     */
    private function format($date)
    {
        return $date->format('d-m-Y H:i:s');
    }

    /**
     * retourne nom user qui a sortie 'LID
     * @return string
     */
    private function getOutUser()
    {
        return $this->whoOut == null ? userName($this->id->out_id_user) : $this->whoOut;
    }

    /**
     * retourne la date formater de la sortie de LID
     * @return mixed
     */
    private function getOutDate()
    {
        return $this->whenOut == null ? $this->format($this->id->out_datetime) : $this->whenOut;
    }

    /**
     * Methode utile qui nous donne tout les emplacement
     * du locator
     */
    private function emplacementAll()
    {
        $this->emplacements = $this->keyword->emplacementAll();
    }

    /**
     *methode qui vas rassembler les info sur celui qui a Auditer  l'ID
     * @return $this
     */
    private function audit()
    {
        if($this->isAudit())
        {
            $this->isAudit = true;
            $this->idAudit = $this->id->aud_id_user;
            $this->whoAudit = $this->getAuditeur();
            $this->whenAudit = $this->getAuditDate();
        }

        return $this;
    }

    /**
     * test si ID audit
     * @return bool
     */
    private function isAudit()
    {
          return $this->id->aud_id_user <> null ? TRUE : FALSE ;
    }

    /**
     * retourne date de l'audit
     * @return mixed
     */
    private function getAuditDate()
    {
        return
            $this->whenAudit == null ?
                $this->format($this->id->aud_datetime) : $this->whenAudit
            ;
    }

    /**
     * Retourne le nom de l'auditeur
     * @return string
     */
    private function getAuditeur()
    {
        return
            $this->whoAudit == null ?
                userName($this->id->aud_id_user) : $this->whoAudit
            ;
    }

    private function state()
    {
        $this->isNew = $this->isNew();
        $this->isHs = $this->isHs();

        return $this;

    }

    private function isNew()
    {
        return $this->id->neuf == 1 ? true : false;
    }

    private function article()
    {
        $this->article = $article = $this->articles->articleSpecification($this->id->article);
        return $this;
    }


}