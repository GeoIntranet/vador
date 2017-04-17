<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 27/12/2016
 * Time: 21:39
 */

namespace App\Http\Controllers\Lib\Achat;


use App\Http\Controllers\Lib\Gestion;
use Carbon\Carbon;

class AchatRenderDelais extends AchatRender implements AchatRenderInterface
{

    public $gestion;
    /**
     * AchatRenderDelais constructor.
     */
    public function __construct(
        $achat,
        $action,
        $po,
        $gestion
    )
    {
        parent::__construct($achat,$action,$po,$gestion);
    }


    /**
     * @return $this
     */
    public function  render()
    {
        $this->user = $this->getUser();
        $this->arrive = $this->getArrive();
        $this->po = $this->getPo();
        $this->fournisseur = $this->getFournisseur();
        $this->getQt();

        ////// FIN --------------------/
        $this->cleanObject();

        return $this;
    }

    public function getDescription()
    {
        return trim(substr($this->description,0,60));
    }

    public function getUser()
    {
        $user = 'inconnue';


        if($this->userExist($this->user))
        {
            $users = $this->getRenderUser($this->user);
            $nom = $users['nom'];
            $prenom = substr($users['prenom'],0,1);

            $user =  $prenom.'.'.$nom.'['.$this->user.']';
            return $user;
        }

        return $user;
    }

    public function getArrive()
    {
        $dt = $this->arrive == '' ? 'NC' : $this->arrive;

        if($this->arrive !== '')
        {
            $dt = new Carbon($this->arrive);
            return $this->gestion->dateLisible($dt,'minWithYear');
        }

        return 'NC';
    }

    public function getPo()
    {
        if( ! $this->hasPo()) return 'NC';

        return $this->po;
    }

    private function getQt()
    {
        $this->qte_d=  $this->qte_d == '' ? 'NC' : $this->qte_d;
        $this->qte_c=  $this->qte_c == '' ? 'NC' : $this->qte_c;
        $this->qte_r=  $this->qte_r == '' ? 'NC' : $this->qte_r;
    }

    private function getFournisseur()
    {
        return   $this->fournisseur == '' ? 'NC' : $this->fournisseur;
    }


}