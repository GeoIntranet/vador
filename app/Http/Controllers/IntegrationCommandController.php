<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Http\controllers\Lib\Horaire\HoraireGestion;
use App\IntegerCommand;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redis;

class IntegrationCommandController extends Controller
{
    protected $now;
    protected $origin;
    protected $dateToIntegrate;
    protected $lastDayIntegrate;
    protected $horaireGestion;
    protected $integrateCommand;
    protected $commande;
    protected $upToDate;
    protected $items;
    protected $itemsDetail;
    protected $itemsUtil;
    protected $doublon;
    protected $massiveEntry;
    protected $failedEntry;


    /**
     * IntegrationCommandController constructor.
     */
    public function __construct(Carbon $carbon , HoraireGestion $horaireGestion, Commande $commande , IntegerCommand $integrateCommand  )
    {
        $this->now = $carbon::now();
        $this->horaireGestion = $horaireGestion;
        $this->origin = $carbon->copy()->createFromDate(2011, 1, 1);
        $this->dateToIntegrate = $this->horaireGestion->DayOuvrable();
        $this->commande = $commande;
        $this->integrateCommand = $integrateCommand;
        $this->entry = [];
        $this->massiveEntry = [];
        $this->failedEntry = [];
    }

    /**
     * Integre les commandes envoyer dans la base a partir de la dernière date enregistrer.
     */
    public function integration()
    {


        /** FLOW **
         * Recherche date a integrer.
         * Test si on est a jour.
         * Recherche les bl envoyé a cette date.
         * Calcul intégration.
         * Return View / ou redirect
         */
        $this->dateToIntegrate = $this->calculDateToIntegrate();
        if(  $this->isUpToDate($this->lastDayIntegrate) == FALSE )
        {
            $this->calculIntegration();
        }

        var_dump($this->itemsUtil);
        var_dump($this->massiveEntry);
        //$this->integrateCommand->insert($this->massiveEntry);
        return ('/////// FIN ');
    }

    /**
     * Integration commande specific
     * @param $command
     */
    public function integrationCommand($command)
    {
        if( $this->isIntegrate($command)) $this->deletingCommand($command);
        $this->calculIntegration();
        $this->integrateCommand->insert($this->massiveEntry);
    }

    /**
     * Integration de toute les commande a une date spécifique
     */
    public function integrationDate($date , $forced = 'disable')
    {
        if($forced == 'enable') $this->deletingDate($date);
        $this->dateToIntegrate = $date;
        $this->calculIntegration();
        $this->integrateCommand->insert($this->massiveEntry);
    }

    /**
     * integration de toute les commande sur un intervalle de date spécifique
     */
    public function integrationIntervall($begin , $end , $forced = 'disable')
    {
        if($forced == 'enable') $this->deletingIntervalle($begin , $end);
    }

    /**
     * Suppresion des commandes a une date donné
     * @param $date
     * @return mixed
     */
    public function deletingDate($date)
    {
        return $this->integrateCommand->where('dt',$date)->delete();
    }

    /**
     * Supression d'une commande specifique
     * @param $command
     * @return mixed
     */
    public function deletingCommand($command)
    {
        return $this->integrateCommand->where('bl',$command)->delete();
    }

    /**
     * Suppression des commandes sur un intervalle de date donnée
     * @param $begin
     * @param $end
     * @return mixed
     */
    public function deletingIntervalle($begin , $end)
    {
        return $this->integrateCommand->whereBetween('bl',[$begin,$end])->delete();
    }

    /**
     * Calcule la prochaine date pour l'integration
     * @return HoraireGestion
     */
    public function calculDateToIntegrate()
    {
        $lastDayIntegrate = $this->integrateCommand->LastDayIntegrate();
        $lastDayIntegrate =  ! isset($lastDayIntegrate->dt) ? $this->origin  : $lastDayIntegrate->dt;
        $this->lastDayIntegrate = $lastDayIntegrate;
        return $this->horaireGestion->DayOuvrable('next', $lastDayIntegrate);
    }

    /**
     * Test si on est a jour entre les commandes envoyé et les commandes integrer
     * @param $lastDayIntegrate
     */
    public function isUpToDate($lastDayIntegrate)
    {
        $lastDayOuvrable = $this->horaireGestion->DayOuvrable('last',$this->now);
        $lastDayIntegrateFormat = $lastDayIntegrate->copy()->format('Y-m-d');
        $lastDayOuvrableFormat = $lastDayOuvrable->copy()->format('Y-m-d');
        return $this->upToDate = $lastDayIntegrateFormat == $lastDayOuvrableFormat ? TRUE : FALSE;
    }

    /**
     *Logique de calcule de l'integration
     */
    public function calculIntegration()
    {
        $this->itemsDetail = $this->getCommandDetail($this->dateToIntegrate) ;
        foreach ($this->itemsDetail->get() as $index => $item)
        {
            /*
            * 1 . trouver la categorie + decode Json -> array.
            * 2  Tri si erreur de catégorie faire notification + trace de la ligne CMD.
            * 2 . mise en forme pour entrée bdd.
            * 3 . save dans la bdd.
            */
            $cache = json_decode ( Redis::hget('CategorieController',$item->type_article) , true );
            $this->sortEntry($cache , $item);
        }
    }

    /**
     * Hydrate les champs bdd avec les variables
     * @param $cache
     * @param $item
     * @return array
     */
    public function hydrate($cache , $item, $object ='massive')
    {
        $ca = $item->prix_unit == 0 ? 0 : $item->prix_unit * $item->qte_livr;
        return $this->massiveEntry[]=
            [
                'dt' => $this->itemsUtil[$item->id_cmd]['date']->format('Y-m-d'),
                'bl' => $item->id_cmd,
                'cmdl' => $item->num_ligne,
                'client' => $this->itemsUtil[$item->id_cmd]['client'],
                'id_user' => $item->id_vendeur,
                'qte' => $item->qte_livr,
                'ca' => $ca,
                'type' => $item->type_article,
                'model' => $item->code_article,
                'designation' => $item->desc_article,
                'prestation' => $item->prestation,
                'therm' => $cache['therm'],
                'pisto' => $cache['pisto'],
                'micro' => $cache['mic'],
                'las' => $cache['las'],
                'mat' => $cache['mat'],
                'as' => $cache['as'],
                'jet' => $cache['jet'],
                'repair' => 0,
            ];
    }

    /**
     * Si categorie null , ca veut dire que l'entree n'est pas catégorisable
     * je la stock dans le tableau des element FAILED
     * sinon j'hydrate le tableau pour insertion dans BDD
     * @param $cache
     * @param $item
     * @return array
     */
    public function sortEntry($cache , $item)
    {
        if($cache === null) return $this->failedEntry[] = $item ;
        return $this->hydrate($cache, $item);
    }

    /**
     * TRUE or FALSE , si bl integrer
     * @param $command
     * @return bool
     */
    public function isIntegrate($command)
    {
        return  $this->integrateCommand->isIntegrate($command) !== 0 ?  TRUE : FALSE ;
    }

    public function getCommandDetail($date)
    {
        $data_item = $this->commande->CommandLast($date);
        $primaryKey = 'id_cmd';

        foreach ($data_item->get() as $index => $item)
        {
            $this->items[]=$item->$primaryKey;
            $this->itemsUtil[$item->id_cmd]=[
                'bl' => $item->id_cmd,
                'date' =>$item->date_livr,
                'client' =>$item->id_clientlivr,
            ];
        }
        return $this->commande->CommandLastOuvrableD($date,$this->items);
    }
}
