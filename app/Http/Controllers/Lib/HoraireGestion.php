<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 28/03/2016
 * Time: 19:01
 */

namespace App\Http\Controllers\Lib;
use App\Horaire;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Redirect;


class HoraireGestion extends Gestion{

    //AIDE -------------------------------------------------------------------------------------------------------------
    // DAY OF WEEK  ----------------------------------------------------------------------------------------------------
    // 0 -  DIMANCHE ---------------------------------------------------------------------------------------------------
    // 1 -  LUNDI  -----------------------------------------------------------------------------------------------------
    // 2 -  MARDI  -----------------------------------------------------------------------------------------------------
    // 3 -  MERCREDI  --------------------------------------------------------------------------------------------------
    // 4 - JEUDI  ------------------------------------------------------------------------------------------------------
    // 5 -  VENDREDI ---------------------------------------------------------------------------------------------------
    // 6 -  SAMEDI -----------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------
    public $planning;
    public $prestations;

    public $heure;
    public $minute;
    public $user ;
    public $ferrier ;
    public $ldtr;
    public $data;
    public $s;

    function __construct(){


        $this->user = Auth::user()->id;

        $this->ldtr = 0;

        $this->planning=[
            1 => '08:00',
            2 => '08:00',
            3 => '08:00',
            4 => '08:00',
            5 => '07:00',
            6 => '00:00',
            7 => '00:00',
        ];

        $this->prestations=[
            'rec' => 'Récupérations',
            'hp'=> 'Heures payées',
            'hnp'=> 'Heures non payées',
            'cp'=> 'Congè payé',
            'cp2'=> 'Demie-journée congé payé',
            'ef'=> 'Enfant malade',
            'n'=> 'Horaire normal',
        ];

        $this->ferrier =collect([
           '2016-01-01',
           '2016-03-28',
           '2016-05-01',
           '2016-05-05',
           '2016-05-08',
           '2016-05-16',
           '2016-07-14',
           '2016-08-15',
           '2016-11-01',
           '2016-11-11',
           '2016-12-25',
        ]);

        $this->s=[
            0 => 'Dimanche',
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'samedi',
        ];

        $this->data=[
            'user' => $this->user,
            'date_r' => '',
            'heures_taff' =>'',
            'com' =>'',
            'recup' => 0,
            'heure_paye' => 0,
            'cp' => 0,
            'cp2' => 0,
            'ef' => 0,
            'hnp' => 0,
        ];

    }

    /**nous retourne la variable planning ( array qui contient les horaire de chaque jour de la semaine
     * @return mixed
     */
    public function getPlanning(){
        return $this->planning;
    }

    /**nous retourne la variable contenant les prestations disponibles
     * @return mixed
     */
    public function getPrestations(){
        return $this->prestations;
    }

    /**retourne la liste des jour ferrier sous forme de tableau
     * @return array
     */
    public function getFerrier(){
        return $this->ferrier;
    }

    /**retourne la derniere date renseigner
     * @return int
     */
    public function getLdtr(){
        return $this->ldtr;
    }

    /**Tableau des jour de la semaine.
     * @return array
     */
    public function getS(){
        return $this->s;
    }


    /**Setter du tableau pour entrée base bdd
     * @param $user
     * @return $this
     */
    public function setDataUser($user){ $this->data['user'] = $user; return $this;}
    public function setDatadt($dt){ $this->data['date_r'] = $dt; return $this;}
    public function setDataH($heure){ $this->data['heures_taff'] = $heure; return $this;}
    public function setDatacom($com){ $this->data['com'] = $com; return $this;}
    public function setDataRecup($recup){ $this->data['recup'] = $recup; return $this;}
    public function setDataHp($hp){ $this->data['heures_paye'] = $hp; return $this;}
    public function setDataCp($cp){ $this->data['cp'] = $cp; return $this;}
    public function setDataCp2($cp2){ $this->data['cp2'] = $cp2; return $this;}
    public function setDataEf($ef){ $this->data['ef'] = $ef; return $this;}
    public function setDataHnp($hnp){ $this->data['hnp'] = $hnp; return $this;}

    public function setPrestation($presta){
        if($presta == 'rec'){   $this->setDataRecup(1);}
        if($presta == 'hp'){    $this->setDataHp(1);}
        if($presta == 'cp'){    $this->setDataCp(1);}
        if($presta == 'cp2'){   $this->setDataCp2(1);}
        if($presta == 'hpn'){   $this->setDataHnp(1);}
        if($presta == 'ef'){    $this->setDataEf(1);}
        return $this;
    }

    /**retourne le tableau de donné
     * @return array
     */
    public function getData(){ return $this->data; }

    /** heure d'entrée , minutes en sortie. AU FORMAT 18:30
     * @param $heure
     * @return int
     */
    public function hm($heure) {
        $this->heure = $heure;
        $this->heure = strstr($this->heure, ':', true);

        $minute = strstr($heure, ':');
        $minute = ltrim($minute, " :");

        $conv_HT_minT = $this->heure * 60;
        $this->minute = $minute + $conv_HT_minT;

        return $this->minute;

    }

    /**des minutes en entrée, une heure en sortie.
     * @param $minutes
     * @return int
     */
    public function mh($minutes){
        $this->minute = $minutes;

        if ($this->minute >= 0) { return sprintf('%02d:%02d', floor($this->minute / 60), $this->minute % 60); }

        if ($this->minute < 0) {
            $this->minute = abs($this->minute);
            return sprintf('-%02d:%02d', floor($this->minute / 60), $this->minute % 60);
        }
        return FALSE;

    }

    /**retourne la derniere date renseigner.
     * @return mixed
     */
    public function ldtr(){

        $this->ldtr = DB::table('horraires')
            ->where('user',$this->user)
            ->orderBy('date_r','desc')
            ->take(1)
            ->first();

        return $this->ldtr;
    }

    /**retourne TRUE or FALSe en fonction si la date est ferrier ou pas.
     * @param $dt
     * @return bool
     */
    public function isFerrier($dt){

        if(is_object($dt)){
           return ($this->ferrier->search($dt->format('Y-m-d')) <> FALSE) ? TRUE : FALSE;
        }
        else{
            return   ($this->ferrier->search($dt) <> FALSE) ? TRUE : FALSE;
        }
    }

    /** nous renseigne si un jour est ouvrable ou non
     * @param $dt
     * @return bool
     */
    public function isOuvrable($dt){

        if(is_object($dt)){
            return ($dt->dayOfWeek == 6 OR $dt->dayOfWeek == 0) ? FALSE : TRUE;
        }
        else{
            $dt = new Carbon($dt);
            return ($dt->dayOfWeek == 6 OR $dt->dayOfWeek == 0) ? FALSE : TRUE;
        }
    }


    /**
     * enregistrement BDD des infos
     */
    public function record(){
        $h = new Horaire();
        $h->user = $this->data['user'];
        $h->date_r = $this->data['date_r'];
        $h->heures_taff = $this->data['heures_taff'];
        $h->com = $this->data['com'];
        $h->recup = $this->data['recup'];
        $h->heure_paye = $this->data['heure_paye'];
        $h->cp = $this->data['cp'];
        $h->cp2 = $this->data['cp2'];
        $h->ef = $this->data['ef'];
        $h->hnp = $this->data['hnp'];
        $h->save();
//        $h = Horaire::create($this->data);
    }

    /** A la recherche de la prochaine date a renseigner. Hors ferrier / hors week end
     *
     */

    public function searchDateAvailable(){

        $carbonLdtr = new Carbon( $this->ldtr->date_r);
        $testNewDt = $carbonLdtr->copy()->addDay(1);

            $state = FALSE;

        while($state == FALSE){

            $isFerrier = $this->isFerrier($testNewDt);
            $isOuvrable = $this->isOuvrable($testNewDt);

            if( ($isFerrier == TRUE) AND ($isOuvrable == TRUE) ){

                if($testNewDt->isFriday()){ $this->setDataH('07:00:00')->setDatadt($testNewDt->format('Y-m-d'))->setDatacom('FERRIER'); }
                else{  $this->setDataH('08:00:00')->setDatadt($testNewDt->format('Y-m-d'))->setDatacom('FERRIER'); }
                $this->record();
                Redirect::route('horaire.index');

            }

            $state = ( ($isFerrier == TRUE) OR ($isOuvrable == FALSE) ) ? FALSE : TRUE;

            if($state == FALSE)  $testNewDt->addDay(1);

        }

        return $testNewDt->format('Y-m-d');

    }

} 