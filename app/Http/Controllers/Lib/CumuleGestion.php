<?php

namespace App\Http\Controllers\Lib;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cumule as Cumule;
use App\User as User;
use Carbon\Carbon;
use Auth;
use Validator;
use Input;
use Redirect;
use DB;

class CumuleGestion extends Gestion {

    public $user;
    public $userNFO;
    public $mconf;
    public $Menu;
    public $U;

    public $dtLastcumule;
    public $dtLastCumuleTheorique;
    public $interval;
    public $today;

    public $rec;
    public $hp;
    public $hnp;
    public $cp;
    public $cp2;
    public $ef;
    public $H;

    public $cumule;
    public $cumuleResult;

    /**AIDE
     * CALCULE MAJORATION
     * de la 39 eme a 43eme Heures INCLUT , 25 %
     * a partir de la 44eme et plus c'est 50 % de majoration
     */


    function __construct(){
        $this->middleware('Location');

        $this->g = New Gestion();
        $this->today = new Carbon();
        $this->cumule = new Cumule();
        $this->U = new User();

        $this->Menu         =       New MenuGestion();
        if(Auth::Check()){
            $this->userNFO      =       Auth::user();
            $this->user         =       $this->userNFO->id;
            $this->Menu->initAuth($this->user);
            $this->mconf['avatar'] = $this->Menu->userIcone();
            $this->mconf['admin'] = ($this->Menu->isAdmin() == TRUE) ? 'admin' : false;

            $this->LastCumuleTheorique();
        }
        else{
            Redirect::to('login')->send();
        }

    }

    /** Getter
     * @return mixed
     */
    public function getRec()    { return $this->rec;    }
    public function getHp()     { return $this->hp;     }
    public function getHnp()    { return $this->hnp;    }
    public function getCp()     { return $this->cp;     }
    public function getCp2()    { return $this->cp2;    }
    public function getEf()     { return $this->ef;     }
    public function getH()      { return $this->H;      }
    public function getLastDtCT(){ return  $this->dtLastCumuleTheorique; }

    /**Setter
     * @param
     */
    public function setRec($rec)    {  $this->rec   = $rec; }
    public function setHp($hp)      {  $this->hp    = $hp;  }
    public function setHnp($hnp)    {  $this->hnp   = $hnp; }
    public function setCp($cp)      {  $this->cp    = $cp;  }
    public function setCp2($cp2)    {  $this->cp2   = $cp2; }
    public function setEf($ef)      {  $this->ef    = $ef;  }
    public function setH($H)        {  $this->H    = $H;   }

    public function resetPresta()   {
        $this->setH(0);
        $this->setHp(0);
        $this->setHnp(0);
        $this->setCp(0);
        $this->setCp2(0);
        $this->setEf(0);
        $this->setRec(0);
    }


    /**Cherche si l'utilisateur a au moin UN cumule , nous le retourne si il trouve , sinon FALSE.
     * @param $id
     * @return bool|mixed
     */
    public function hasCumule($id){
        $test = $this->cumule->lastCumule($id);
        return ($test <> NULL) ? $test : FALSE;
    }

    /**
     * retourne le cumule ou FALSe , en fonction de si on est a jour ou pas.
     * On peut forcer le cumule de la semaine en cours, si on a rempli les horaire de facon ANTICIPER
     * @param $id
     * @param $force
     * @return bool
     */
    public function hasLVL($id,$force){
        $this->dtLastCumuleTheorique = ($force == 0) ? $this->dtLastCumuleTheorique : $this->dtLastCumuleTheorique->addweek(1);
        $present = $this->cumule->presentCumule($id,$this->dtLastCumuleTheorique);

        return ($present == FALSE) ? FALSE : $present;

    }

    /**Nous retourne la date a laquelle a du etre enregistrer le DERNIER CUMULE
     * @return static
     */
    public function LastCumuleTheorique(){
        $this->dtLastCumuleTheorique = $this->today->copy()->endOfWeek()->subWeek(1);
    }


    public function CompleteSemaine($array){
        return ( count($array) == 5 ) ? TRUE : FALSE;
    }


    public function InitCumule($id){
    }

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

        if ($minutes >= 0) { return sprintf('%02d:%02d', floor($minutes / 60), $minutes % 60); }

        if ($minutes < 0) {
            $minutes = abs($minutes);
            return sprintf('-%02d:%02d', floor($minutes / 60), $minutes % 60);
        }
        return FALSE;

    }

    public function GetDtCumule($dt){
        $dt = (is_object($dt)) ? $dt : new Carbon($dt);
        return $dt->endOfWeek()->subWeek(1);
    }

}
