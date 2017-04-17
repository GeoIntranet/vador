<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 10/02/2016
 * Time: 11:38
 */
namespace App\Http\Controllers;

use Carbon\Carbon;

class Gestion extends Controller{



    /**FONCTiON DE RECHERCHE D'UN FORMAT DATe DANS UNE CHAINE DE CHAR
     * @param $research
     * @return mixed
     */
    public function DateSearch($research){
        preg_match_all ("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})|",$research,$dtres);
        return $dtres;
    }

    /**FONCTiON DE RECHERCHE D'UN FORMAT TIME DANS UNE CHAINE DE CHAR
     * @param $research
     * @return mixed
     */
    public function TimeSearch($research){
         preg_match_all ("|([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})|",$research,$timeres);
        return $timeres;
    }

    public function Doublon($table){

        $doublons = false; // valeur pas défaut
        $freq = array_count_values($table);
        // frequence de chaque valeur du $tableau

        foreach ($freq as $valeur)
        {
            if ($valeur != 1)
            {
                $doublons = true;
                break; // on sort de la boucle
            }
        }
        return $doublons;
    }

    public function decompose($date)
    {

        $this->test_jour = $date;

        if ($this->test_jour->dayOfWeek == Carbon::DIMANCHE) {
            $array["jour"] = 'Dimanche';
        }

        if ($this->test_jour->dayOfWeek == Carbon::LUNDI) {
            $array["jour"] = 'Lundi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::MARDI) {
            $array["jour"] = 'Mardi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::MERCREDI) {
            $array["jour"] = 'Mercredi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::JEUDI) {
            $array["jour"] = 'Jeudi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::VENDREDI) {
            $array["jour"] = 'Vendredi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::SAMEDI) {
            $array["jour"] = 'Samedi';
        }

        $j = $date->format('d');
        $Y = $date->format('Y');
        $array['num_j'] = $j;
        $m = $date->format('Y-m-d');
        $m = substr($m, -5, 2);


        switch ($m) {

            case $m === '01':
                $array["mois"] = 'Janvier';
                $array["num_m"] = $m;
                break;

            case $m === '02':
                $array["mois"] = 'Fevrier';
                $array["num_m"] = $m;
                break;

            case $m === '03':
                $array["mois"] = 'Mars';
                $array["num_m"] = $m;
                break;

            case $m === '04':
                $array["mois"] = 'Avril';
                $array["num_m"] = $m;
                break;

            case $m === '05':
                $array["mois"] = 'Mai';
                $array["num_m"] = $m;
                break;

            case $m === '06':
                $array["mois"] = 'Juin';
                $array["num_m"] = $m;
                break;

            case $m === '07':
                $array["mois"] = 'Juillet';
                $array["num_m"] = $m;
                break;

            case $m === '08':
                $array["mois"] = 'Aout';
                $array["num_m"] = $m;
                break;

            case $m === '09':
                $array["mois"] = 'Septembre';
                $array["num_m"] = $m;
                break;

            case $m === '10':
                $array["mois"] = 'Octobre';
                $array["num_m"] = $m;
                break;

            case $m === '11':
                $array["mois"] = 'Novembre';
                $array["num_m"] = $m;
                break;

            case $m === '12':
                $array["mois"] = 'Decembre';
                $array["num_m"] = $m;
                break;
        }
        $array['Y'] = $Y;
        return $array;

    }

    public function NumberOrder_($dti_){



        if ($dti_->dayOfWeek == carbon::LUNDI){
            $this->DayOrder = 1;
        } ;

        if ($dti_->dayOfWeek == carbon::MARDI){
            $this->DayOrder = 2;
        } ;

        if ($dti_->dayOfWeek == carbon::MERCREDI){
            $this->DayOrder = 3;
        } ;

        if ($dti_->dayOfWeek == carbon::JEUDI){
            $this->DayOrder = 4;
        } ;

        if ($dti_->dayOfWeek == carbon::VENDREDI){
            $this->DayOrder = 5;
        } ;

        if ($dti_->dayOfWeek == carbon::SAMEDI){
            $this->DayOrder = 6;
        } ;

        if ($dti_->dayOfWeek == carbon::DIMANCHE){
            $this->DayOrder = 7;
        } ;

        return $this->DayOrder;
    }

    public function DtOuvrable($dti_){
        //var_dump($dti_);
        $num = $this->NumberOrder_($dti_);

        if( $num == 6 OR  $num == 7 ){
            $ouvrable = FALSE;
        }else{
            $ouvrable = TRUE;
        }
        $gen =[
            'num' => $num ,
            'state' => $ouvrable
        ];
        return $gen;

    }


    static function XOrder($dt){

        if(is_object($dt)){
            var_dump($dt);

        }
        else{
            $dtOuvrable = self::CarbonDate($dt);
            var_dump($dt);

        }


    }

    function Money($digit) {

        if ($digit >= 1000000000) {
            return round($digit/ 1000000000, 1).'G';
        }
        if ($digit >= 1000000) {
            return round($digit/ 1000000, 1).'M';
        }
        if ($digit >= 1000) {
            return round($digit/ 1000, 1).'K';
        }

        $sig = substr($digit,-1);

        if( $sig == 'M' OR $sig == 'G' OR $sig == 'K' ) {
            $money_ = $digit;
        }else{
            $money_ = substr($digit, 0, -3).'e';
        }
        return $digit;
    }

    public function ARS($array, $cols){

        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;
    }

    public function EVO($int){

        //$int = 88;
        //var_dump($int > 50 AND $int < 500000);



        if( $int >= '-10000000' AND $int <= '-50'){ return '--'; }
        elseif($int >= '-50' AND $int <= '-4'){ return '-';}
        elseif($int >=  '-3' AND $int <= '3'){ return '=';}
        elseif($int > '3' AND $int < '50'){ return '+';}
        elseif($int >= '50' AND $int < '500000'){ return '++';}
        else{ return 'x';}

    }


    public function array_pos($needle, $haystack, $match_all=false,$sub, $preg_mode=false)
    {
        if ($match_all) $matches = array();

        foreach ($haystack as $i => $row) {
            if (is_array($row)) {
                if (!$preg_mode) {
                    if (strpos($row['nom'], $needle) !== false) {
                        if (!$match_all) return $i;
                        else array_push($matches, $row);
                    }
                }
                else
                {
                    if (preg_match($needle, $row) === 1) {
                        if (!$match_all) return $i;
                        else array_push($matches, $i);
                    }
                }
            }
        }

        if (!$match_all) return false;
        return $matches;
    }

} 