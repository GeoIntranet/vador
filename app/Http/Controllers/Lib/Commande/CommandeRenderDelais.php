<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 11/01/2017
 * Time: 21:49
 */

namespace App\Http\controllers\Lib\Commande;


use App\Http\Controllers\Lib\Render;

class CommandeRenderDelais extends Render
{
    public  $commande;
    public  $clients;
    public  $gestion;

    public  $client;
    public  $user;
    public  $bl;
    public  $info;
    public  $date;

    /**
     * CommandeRenderDelais constructor.
     * @param $commandes
     * @param $clients
     * @param $gestion
     */
    public function __construct($commande, $clients, $gestion)
    {
        $this->commande = $commande;
        $this->clients = $clients;
        $this->gestion = $gestion;

        parent::__construct($gestion);
    }



    public function handle()
    {
        $this->getUser();
        $this->getClient();
        $this->getBl();
        $this->getInfo();
        $this->getDate();

        $this->clean();

        return $this;
    }

    public function clean()
    {
        unset($this->gestion);
        unset($this->commande);
        unset($this->clients);
    }

    public function getUser()
    {
        $user = 'inconnue';

        $this->user = $this->commande['id_vendeur'];

        if($this->userExist($this->user))
        {
            $users = $this->getRenderUser($this->user);
            $nom = $users['nom'];
            $prenom = substr($users['prenom'],0,1);

            $this->user =  $prenom.'.'.$nom.' [ <i>'.$this->user.'</i> ]';
        }

    }

    private function getClient()
    {
        $this->client = $this->clients[$this->commande['id_clientlivr']];
    }

    private function getBl()
    {
        $this->bl = $this->commande['id_cmd'];
    }

    private function getInfo()
    {
        $this->info = $this->commande['info_prod'];
    }

    private function getDate()
    {
        $this->date = $this->gestion->dateLisible($this->commande['date_cmd'],'minWithYear');
    }
}