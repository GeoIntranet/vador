<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 07/10/2016
 * Time: 13:37
 */

namespace App\Http\Controllers\Lib\Stat;

use App\Client;
use App\Commande;
use App\LigneCommande;
use Carbon\Carbon;

class ClassifyGestion
{

    protected $clients ;
    protected $client ;
    protected $prestation;
    protected $categorie;
    protected $bl ;
    protected $fetchInfo ;
    protected $cp ;
    protected $commandSent ;
    protected $commande ;
    protected $counterLigne ;
    protected $utileLigne ;
    protected $verification ;
    protected $totalVerification ;
    protected $localInteger ;
    protected $integer ;
    protected $excludeInteger ;
    protected $cat ;

    /**
     * ClassifyGestion constructor.
     */
    public function __construct(Commande $commande, LigneCommande $ligne, Client $client )
    {
        $this->commande = $commande;
        $this->ligneCommande = $ligne;
        $this->client = $client;
        $this->lignesCommandes= [];
        $this->clients =[];
        $this->prestation =[];
        $this->categorie =[];
        $this->bl =[];
        $this->commandSent =[];
        $this->counterLigne =0;
        $this->utileLigne =0;
        $this->verification =0;
        $this->totalVerification =[];
        $this->localInteger =[];
        $this->integer =[];
        $this->excludeInteger =[];
        $this->cp =[];
        $this->fetchInfo =[];
    }

    /**
     * @param array $client
     */
    public function setClients($client)
    {
        $this->clients = $client;
    }

    public function setCommandSent($command)
    {
        $this->commandSent = $command;
    }

    public function getCommandSent()
    {
        return $this->commandSent;
    }

    /**
     * recherche différent info client / client livrée / facturée / son code postale 
     */
    public function getInformationClient()
    {
        /* extraction de la colonne BL */
        $this->bl = array_column($this->commandSent,'id_cmd');

        /*Associe dans un tableau le bl au client et a la date d'envoie.*/
        $this->fetchInfo = array_combine($this->bl,$this->commandSent);

        /* extraction de la colonne client  livrée */
        $this->clients = array_column($this->commandSent,'id_clientlivr');

        /* recherche du codepostale des client livrée indiquer dans tableau */
        $this->cp = $this->client->Cp($this->clients)->pluck('cp','id_client');

        //var_dump($this->cp);
        //var_dump($this->bl);
        //var_dump($this->clients);
    }

    public function setLigneCommande($bl)
    {
        $this->lignesCommandes = $this->ligneCommande->whereIn('id_cmd',$bl)->get();
        //var_dump($this->lignesCommandes);
    }

    public function calculate()
    {
        $this->loop($this->lignesCommandes);
    }

    public function loop($data)
    {
        foreach ($data as $index => $lignesCommande) {
            $this->controlle($lignesCommande);
        }
    }

    public function controlle($data)
    {

        if( (! $this->exeption($data)) AND (isset($this->categorie[$data->type_article])) )
        {
            $this->fill($data);
        }
        else
        {
            $this->excludingData($data);
        }
    }

    /**
     * return si oui ou non la categorie est exclus.
     * @param $type
     * @return bool
     */
    public function exeption($data)
    {
        $code = $data->code_article;
        $type = $data->type_article;


        return ($type == 'DIVERS' && $code <> 'FAX*') ? true : false;
    }

    public function fill($data)
    {
        $detail = $this->detailData($data);
        $cat =$this->searchCategorie($detail['categorie']);
        //var_dump($cat);

        $this->integer[]=[
            'bl' => $data->id_cmd,
            'commande_ligne' => $data->num_ligne,
            'date_cmd' => $detail['date_cmd'],
            'date_livr' => $detail['date_livr'],
            'client_livr' => $detail['client_livr'],
            'client_fact' => $detail['client_fact'],
            'laps_time' => $detail['laps_time'],
            'cp' => $detail['cp'],
            'id_user' => $data->id_vendeur,
            'code_as' => $data->type_article,
            'designation' => $data->code_article,
            'description' => $data->desc_article,
            'export_fr' => $data->fr_export,
            'garantie' => $data->nbm_garantie,
            'qt_c' => $data->qte_cmd,
            'qt_l' => $data->qte_livr,
            'qt_f' => $data->qte_fact,
            'option' =>  $detail['option'],
            'prix_unit' => $data->prix_unit,
            'total' => $detail['total'],
            'prestation' => $data->prestation,
            'therm' => $cat['therm'],
            'pisto' => $cat['pisto'],
            'micro' => $cat['micro'],
            'las' => $cat['las'],
            'mat' => $cat['mat'],
            'as' => $cat['as'],
            'jet' => $cat['jet'],
            'mo' => $cat['mo'],
            'tps' => $cat['tps'],
            'facture' => $data->id_facture,
            'repair' => 0,
        ];
    }

    public function detailData($data)
    {
        $dt_livr =  isset($this->fetchInfo[$data->id_cmd]['date_livr']) ? new Carbon($this->fetchInfo[$data->id_cmd]['date_livr']): false ;
        $dt_cmd =  isset($this->fetchInfo[$data->id_cmd]['date_cmd']) ? new Carbon($this->fetchInfo[$data->id_cmd]['date_cmd']): false ;

        $data['client_livr'] = isset($this->fetchInfo[$data->id_cmd]['id_clientlivr']) ? $this->fetchInfo[$data->id_cmd]['id_clientlivr']: false ;
        $data['client_fact'] = isset($this->fetchInfo[$data->id_cmd]['id_clientfact']) ? $this->fetchInfo[$data->id_cmd]['id_clientfact']: false ;
        $data['cp'] = isset($this->cp[$data['client_livr']]) ? $this->cp[$data['client_livr']]: false ;
        $data['total'] = $data->prix_unit * $data->qte_fact ;
        $data['date_livr'] = is_object($dt_livr) ? $dt_livr->copy()->format('Y-m-d') : $dt_livr;
        $data['date_cmd'] = is_object($dt_cmd) ? $dt_cmd->copy()->format('Y-m-d') : $dt_livr;
        $data['option'] = substr($data->code_article,-1,1) == '*' ? TRUE : FALSE ;
        $data['laps_time'] = (is_object($dt_livr) AND is_object($dt_cmd)) ? $dt_livr->diffInMinutes($dt_cmd) :false ;
        $data['categorie'] = collect(json_decode($this->categorie[$data->type_article]))->search(1) ;

        return $data;
    }

    public function excludingData($data)
    {
        $code = $data->code_article;
        $type = $data->type_article;

        if($type <> 'DIVERS' && $code <> 'COMMANDE')
        {
            $dt_livr =  isset($this->fetchInfo[$data->id_cmd]['date_livr']) ? new Carbon($this->fetchInfo[$data->id_cmd]['date_livr']): false ;
            $this->excludeInteger[]=[
                'bl' => $data->id_cmd,
                'date_livr' => $dt_livr,
                'commande_ligne' => $data->num_ligne,
                'id_user' => $data->id_vendeur,
                'code_as' => $data->type_article,
                'designation' => $data->code_article,
            ];
        }

    }

    public function findCategorie($ligne)
    {
        $cats= [
            'therm' => 0,
            'pisto' => 0,
            'micro' => 0,
            'las' => 0,
            'mat' => 0,
            'as' => 0,
            'jet' => 0,
            'mo' => 0,
            'tps' => 0,
        ];
        $selected = 0;

        foreach ($cats as  $cat_ => $cat)
        {
            if($ligne->$cat_ == 1)
            {
                $cats[$cat_] = 1;
                $selected = $cat_;
            }
        }
        $cats_['all'] = $cats;
        $cats_['selected'] = $selected;

        return $cats_;
    }

    public function searchCategorie($cat)
    {
        $cats= [
            'therm' => 0,
            'pisto' => 0,
            'micro' => 0,
            'las' => 0,
            'mat' => 0,
            'as' => 0,
            'jet' => 0,
            'mo' => 0,
            'tps' => 0,
        ];

        $cats[$cat] =1;

       return $cats;
    }

    /**
     * retourne les categorie
     * @return array
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * returne le tableau ligne exlcuses
     * @return mixed
     */
    public function getExlcude()
    {
        return $this->excludeInteger;
    }

    /**
     * retourne le tableau ligne incluse
     * @return array
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * retourne tableau diff info lié client cp / etc..
     * @return array
     */
    public function getFetchInfo()
    {
        return $this->fetchInfo;
    }

    /**
     * retourne tableau ligne commandes
     * @return array
     */
    public function getLignesCommandes()
    {
        return $this->lignesCommandes;
    }

    /**
     * retourne tableau des clients
     * @return array
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * retourne tableau des bl
     * @return array
     */
    public function getBl()
    {
        return $this->bl;
    }

    /**
     *
     * @param array $prestation
     */
    public function setPrestation($prestation)
    {
        $this->prestation = $prestation;
    }

    /**
     *
     * @param array $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @param array $bl
     */
    public function setBl($bl)
    {
        $this->bl = $bl;
    }





    public function checkIntegrity()
    {
        
    }


}