<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 08/09/2016
 * Time: 16:10
 */

namespace App\Http\Controllers\Lib\Stat;


use App\Commande;
use App\Http\Controllers\Lib\User\UserGestion;
use App\Incident;
use App\Stock;
use Carbon\Carbon;

class StatUserGestion extends UserGestion
{


    protected $userGlobal;
    protected $option;
    protected $locator;
    protected $commande;
    protected $now;
    protected $yearBegin;
    protected $yearEnd;
    protected $detailYear;
    protected $detailIncidentYear;
    protected $moyenneIncidentYear;
    protected $invalidformat;


    /**
     * StatUserGestion constructor.
     */
    public function __construct(Incident $incident , Stock $locator, Commande $commande, Carbon $carbon)
    {
        $this->locator = $locator;
        $this->commande = $commande;
        $this->incident = $incident;
        $this->option = [];
        $this->now = $carbon::now();
        $this->yearBegin = $carbon::create($this->now->copy()->year,1,1,0,0,0);
        $this->yearEnd = $carbon::create($this->now->copy()->year,12,31,23,0,0);
        $this->detailYear =[];
        $this->detailIncidentYear =[];
        $this->invalidformat=[];
    }

    public function getNow()
    {

        return $this->now;
    }
    /**
     * nous donne les sortie par utilisateur sur une periode donné .
     * @param $option
     * @return mixed
     */
    public function sortie($option)
    {
        return $this->locator->Sortie($option);
    }

    /**
     * Nous donne les Bl dans lequelle l'utilisateur a produit
     * @param $option
     * @return mixed
     */
    public function contribution($option,$user)
    {
        return $this->locator->ContributionCommand($option,$user);
    }

    /**
     * Recherche les incidents liée a un ou plusieur utilisateur donné
     * @param $option
     * @return mixed
     */
    public function searchParticipation($option,$name)
    {
        /*WorkFlow- Boucle sur user - Search incident by user - Disptach by user/month - Return final table*/
        foreach ($option['user'] as $user)
        {
            $nom = $name[$user]['nom'];

            $searchParticipation = $this->searchIncidentParticipation($nom,$option['intervalle']);
            $this->dispatchIncidentUser($user,$searchParticipation);
            $this->detailIncidentYear[$user]['count'] = count($searchParticipation);
        }
    }

    public function dispatchIncidentUser($user,$incidents)
    {
        foreach ($incidents as $keyIncident => $incident)
        {
            $month = $incident->open->month;
            $numIncident = $incident->id_incid;
            $create=$incident->open;

            $this->detailIncidentYear[$user]['detail'][$month][$numIncident] = $incident->titre;
            $this->detailIncidentYear[$user]['countByMonth'][$month]=count($this->detailIncidentYear[$user]['detail'][$month]);
        }
    }

    public function calculeMoyenne($data, $userList , $monthList)
    {
        $totalUser= count($userList);

        foreach ($monthList as $kmonth => $valueMonth)
        {
            $totalcount=0;

            foreach ($userList as $user)
            {
                if(isset($data[$user]['countByMonth'][$kmonth]))
                {
                    $totalcount = $totalcount+ $data[$user]['countByMonth'][$kmonth];
                }
            }
            $this->moyenneIncidentYear[$kmonth]= round($totalcount / $totalUser );
        }
    }

    public function getMoyenneIncidentYear()
    {
        return $this->moyenneIncidentYear;
    }

    /**
     * Recherche liste incident par nom de la personne sur intervalle detemps donné
     * @param $user
     * @param $option
     * @return mixed
     */
    public function searchIncidentParticipation($user,$option)
    {
        return $this->incident->userIncident($user,$option);
    }


    /**
     * Initialisation des option USer et date pour savoir comment calculer les donnée
     * liste utilisateur ou utilisateur specifique avec un intervalle de date
     * @param $user
     * @param $year
     */
    public function initOption($user , $year, $userGobal)
    {
        $this->userGlobal = ($userGobal);
        $this->option['intervalle'] = '';
        $this->option['user'] = '';

        //VERIFIE SI USER EXIST AVANT
        $this->initUser($user);
        $this->getIntervalle($year);
    }

    /**
     * retourne le tableau des option
     * @return array
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * initialise les utilisateurs qui seront integrer dans les stat
     * @param $user
     * @return mixed
     */
    public function initUser($user)
    {
        if( $user !== 'all')
        {
            return $this->option['user'] = $this->userExist($user) ? [intval($user)] : $this->userGlobal ;
        }
        return $this->option['user'] = $this->userGlobal;
    }

    /**
     * verifie si utilisateur exist dans base
     * @param $user
     * @return bool
     */
    public function userExist($user)
    {
        $flipedArray = array_flip($this->userGlobal);
        return isset($flipedArray[$user]);
    }

    /**
     * calcule l'intervall de tremps dans lequelle les stat vont etre calculé
     * @param $year
     * @return array
     */
    public function getIntervalle($year)
    {
        $year = $this->checkYear($year);
        $this->yearBegin->year = $year;
        $this->yearEnd->year = $year;
        $this->option['intervalle'] = [];
        $this->option['intervalle']['begin'] = $this->yearBegin;
        $this->option['intervalle']['end'] = $this->yearEnd;
    }

    public function checkYear($year)
    {
        $availableYears= array_flip([2014,2015,2016]);
        return isset($availableYears[$year]) ? intval($year) : $this->now->copy()->year;
    }

    /**
     * boucle sur les différentes entrée BDD , pour trie par mois
     * @param $request
     */
    public function byMonth($request)
    {
        foreach ($request as $index => $item)
        {
            $this->dispatch($item);
        }
    }

    /**
     * trie des différente entrée dans un tableau
     * @param mixed $item
     */
    public function dispatch($item)
    {
        $user = $item->out_id_user;
        $bl = $item->out_id_cmd;
        $date = $item->out_datetime;
        $month = $item->out_datetime->month;

        if($this->validFormatCommand($bl))
        {
            $this->detailYear[$user][$month][$bl]='';
        }

    }

    /**
     * @param $user
     * @param $km
     * @return bool
     */
    public function presenceData($user, $km)
    {
        return isset($this->detailYear[$user][$km]);
    }

    /**
     * retourne tableau detaillé des commande préparer par user
     * @return array
     */
    public function getDetailYear()
    {
        return $this->detailYear ;
    }

    /**
     * retourne tableau detaillé des incidents gerer par user
     * @return mixed
     */
    public function getDetailIncidentYear()
    {
        return $this->detailIncidentYear;
    }

    public function validFormatCommand($command)
    {
        if(is_numeric($command)){
            return true;
        }
        $this->invalidformat[] = $command;
        return false;
    }

    public function getInvalidFormat()
    {
        return $this->invalidformat;
    }


    public function commandes($option)
    {
        return $this->commande->CommandYear($option);
    }


}