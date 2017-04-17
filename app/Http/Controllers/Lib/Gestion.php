<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 10/02/2016
 * Time: 11:38
 */
namespace App\Http\Controllers\Lib;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class Gestion extends Controller{


    // PRESTATION ------------------------------------------------------------------------------------------------------

    const ALLPRESTA = 666;
    const GARANTIE = 0;
    const ECHSTD = 1;
    const REPAIR = 2;
    const VENTERMKT = 3;
    const LOCATION = 4;
    const EXTGARANTIE = 5;
    const MAINTENANCE = 6;
    const TPS = 7;
    const VENTEP = 8;
    const INTER = 9;

    /**
     * liste litteral des prestation
     * @var array
     */
    protected $prestation=[
        self::GARANTIE => 'Garantie',
        self::ECHSTD => 'Echange standard',
        self::REPAIR => 'Reparation',
        self::VENTERMKT => 'Vente Rmkt',
        self::LOCATION => 'Location',
        self::MAINTENANCE => 'Maintenance',
        self::TPS => 'Transport',
        self::EXTGARANTIE => 'Extension garantie',
        self::VENTEP => 'Vente pure',
        self::INTER => 'Intervention',
    ];

    /**
     * liste abreger des prestation
     * @var array
     */
    protected $prestationMin=[
        self::GARANTIE => 'Gar',
        self::ECHSTD => 'Ech/std',
        self::REPAIR => 'Rep',
        self::VENTERMKT => 'Vt/Rmkt',
        self::LOCATION => 'Loc',
        self::MAINTENANCE => 'Main',
        self::TPS => 'Tps',
        self::EXTGARANTIE => 'Ext/g',
        self::VENTEP => 'Vt/p',
        self::INTER => 'Int',
    ];

    // CATEGORIE -------------------------------------------------------------------------------------------------------
    const ALLCAT  = 1;
    const THERMIQUE  = 'therm';
    const MICRO  = 'mic';
    const PISTO  = 'pisto';
    const LASER  = 'las';
    const MATRICIEL  = 'mat';
    const AS400  = 'as';
    const JET  = 'jet';
    const TRPS  = 'tps';
    const MO  = 'mo';

    /**
     * liste litteral des categories
     * @var array
     */
    protected $categorie=[
       self::THERMIQUE => 'Thermique',
       self::MICRO => 'Micro',
       self::PISTO => 'Pistolet',
       self::LASER => 'Laser',
       self::MATRICIEL => 'Matricielle',
       self::AS400 => 'As400',
       self::JET => 'Jet d\'encre',
       self::TRPS => 'Transport',
       self::MO => 'Main d\'oeuvre',
    ];

    protected $categorieDB=[
        self::THERMIQUE  ,
        self::MICRO  ,
        self::PISTO  ,
        self::LASER  ,
        self::MATRICIEL  ,
        self::AS400  ,
        self::JET  ,
    ];

    protected $categorieMin=[
        self::THERMIQUE => 'Therm',
        self::MICRO => 'Micro',
        self::PISTO => 'Pisto',
        self::LASER => 'Las',
        self::MATRICIEL => 'Mat',
        self::AS400 => 'As',
        self::JET => 'Jet',
        self::TRPS => 'Tps',
        self::MO => 'MO',
    ];

    //USER -------------------------------------------------------------------------------------------------------------
    //TECH -------------------------------------------------------------------------------------------------------------
    const GV = 48;
    const BV = 75;
    const ABR = 59;
    const CC = 51;
    const FRB = 63;
    const FLM = 56;
    const LG = 24;
    const PH = 38;
    const SP = 27;
    const TC = 60;
    const TH = 76;


    //COM---------------------------------------------------------------------------------------------------------------
    const BA = 78;
    const FRI = 32;
    const CLR = 37;
    const CR =  72;
    const DA = 52;
    const DM = 35;
    const EQ = 47;
    const FB = 70;
    const IQ = 62;
    const MD = 64;
    const WL = 14;
    const FRA = 10;
    const LP = 81;
    const RMD = 83;

    /**
     * liste des id users technicien
     * @var array
     */
    protected $technicien=[
        self::GV ,
        self::ABR ,
        self::CC ,
        self::FLM ,
        self::PH,
        self::TC,
        self::TH,
        self::BV,
    ];

    /**
     * liste des id users auditeur
     * @var array
     */
    protected $auditeur=[
        self::TH,
    ];

    /**
     * liste des id user qui font entrée en stock
     * @var array
     */
    protected $inStock=[
        self::TH,
        self::LG,
    ];

    /**
     * liste id user commerciaux
     * @var array
     */
    protected $commercial=[
        self::EQ,
        self::IQ,
        self::WL,
        self::FRI,
        self::FB,
        self::DM,
        self::LP,
        self::RMD,
    ];

    protected $vendeurDelais=[
        self::IQ,
        self::WL,
        self::FRI,
        self::FB,
        self::DM,
        self::GV,
        self::CC,
        self::FLM,
        self::TC,
        self::PH,
        self::SP,
        self::ABR,
        self::LP,
        self::RMD,
    ];

    /**
     * list all id user + nom + prenom
     * @var array
     */
    public $users=[
        self::BA => ['nom' => 'HAYE' , 'prenom' =>  'Bérénice' , 'id' => self::BA ],
        self::FRA => ['nom' => 'RAJAOFERA' , 'prenom' =>  'Franck' , 'id' => self::BA ],
        self::FRI => ['nom' => 'RIVARD' , 'prenom' => 'Franck' , 'id' => self::FRI  ],
        self::CR => ['nom' => 'RENAUT' , 'prenom' => 'Clément' , 'id' => self::CR  ],
        self::DM => ['nom' => 'MINGAZ' , 'prenom' =>  'Diane'       , 'id' => self::DM],
        self::EQ => ['nom' => 'QUERI' , 'prenom' =>  'Elsa'         , 'id' => self::EQ],
        self::FB => ['nom' => 'BUINEAU' , 'prenom' =>  'François'   , 'id' => self::FB],
        self::IQ => ['nom' => 'QUERI' , 'prenom' =>  'Ingrid'       , 'id' => self::IQ],
        self::MD => ['nom' => 'DEBOSSCHERE' , 'prenom' =>  'Marie'  , 'id' => self::MD],
        self::WL => ['nom' => 'LECERF' , 'prenom' =>  'William'     , 'id' => self::WL],
        self::GV => ['nom' => 'VALERO' , 'prenom' =>  'Geoffrey'    , 'id' => self::GV],
        self::BV => ['nom' => 'VALENCELLE' , 'prenom' =>  'Bernard' , 'id' => self::BV],
        self::ABR => ['nom' => 'VD BRANDEN' , 'prenom' =>  'Amaury'  , 'id' => self::ABR   ],
        self::CC => ['nom' => 'CREZE' , 'prenom' =>  'Christophe'    , 'id' => self::CC   ],
        self::FLM => ['nom' => 'LE MOINE' , 'prenom' =>  'François'  , 'id' => self::FLM   ],
        self::LG => ['nom' => 'GERBAUD' , 'prenom' =>  'Laurence'    , 'id' => self::LG   ],
        self::PH => ['nom' => 'HORTIN' , 'prenom' =>  'Pascal'       , 'id' => self::PH   ],
        self::SP => ['nom' => 'PAVI' , 'prenom' =>  'Stephane'       , 'id' => self::SP   ],
        self::TC => ['nom' => 'CIRIO' , 'prenom' =>  'Thierry'       , 'id' => self::TC   ],
        self::TH => ['nom' => 'HUBERT' , 'prenom' =>  'Thomas'       , 'id' => self::TH   ],
        self::LP => ['nom' => 'PEYRON' , 'prenom' =>  'Lucile'       , 'id' => self::LP   ],
        self::RMD => ['nom' => 'DASSE' , 'prenom' =>  'Rose-Marie'       , 'id' => self::RMD   ],
    ];
    public $avatars=[
        self::BA => 'BH',
        self::FRA => '',
        self::FRI => 'FRI',
        self::CR => 'CR',
        self::DM => 'DM',
        self::EQ => 'EQ',
        self::FB => 'FB',
        self::IQ => 'IQ',
        self::MD => 'MD',
        self::WL => 'WL',
        self::GV => 'GV',
        self::BV => 'BV',
        self::ABR => 'VDB',
        self::CC => 'CC',
        self::FLM => 'FLM',
        self::LG => 'LG',
        self::PH => 'PH',
        self::SP => 'SP',
        self::TC => 'TC',
        self::TH => 'TH',
    ];

    // MOIS --------------------------------------------------------------------------------------------------------------------------------
    CONST JANVIER = 1;
    CONST FEVRIER = 2;
    CONST MARS = 3;
    CONST AVRIL = 4;
    CONST MAI = 5;
    CONST JUIN = 6;
    CONST JUILLET = 7;
    CONST AOUT = 8;
    CONST SEPTEMBRE = 9;
    CONST OCTOBRE = 10;
    CONST NOVEMBRE = 11;
    CONST DECEMBRE = 12;

    /**
     * calendrier des mois
     * @var array
     */
    protected $calender = [
        self::JANVIER => 'Janvier',
        self::FEVRIER => 'Février',
        self::MARS => 'Mars',
        self::AVRIL => 'Avril',
        self::MAI => 'Mai',
        self::JUIN => 'Juin',
        self::JUILLET => 'Juillet',
        self::AOUT => 'Aout',
        self::SEPTEMBRE => 'Septembre',
        self::OCTOBRE => 'Octobre',
        self::NOVEMBRE => 'Novembre',
        self::DECEMBRE => 'Decembre',
    ];
    protected $calenderMin = [
        self::JANVIER => 'Jan',
        self::FEVRIER => 'Fév',
        self::MARS => 'Mar',
        self::AVRIL => 'Avr',
        self::MAI => 'Mai',
        self::JUIN => 'Juin',
        self::JUILLET => 'Juill',
        self::AOUT => 'Aout',
        self::SEPTEMBRE => 'Sept',
        self::OCTOBRE => 'Oct',
        self::NOVEMBRE => 'Nov',
        self::DECEMBRE => 'Déc',
    ];



    /**
     * Nous retourn les prestations
     * @return array
     */
    public function getPrestation()
    {
        return $this->prestation;
    }

    public function getCategorieDB()
    {
        return $this->categorieDB;
    }
    /**
     * Nous retourne les prestations Minimifier
     * @return array
     */
    public function getPrestationMin()
    {
        return $this->prestationMin;
    }

    /**
     * retourne les categorie
     * @return array
     */
    public function getCategorieGlobal()
    {
        return $this->categorie;
    }

    /**
     * retourne les categorie minimifier
     * @return array
     */
    public function getCategorieMin()
    {
        return $this->categorieMin;
    }

    public function now()
    {
        return new Carbon();
    }
    /**
     * retourne les utilisateur technicien
     * @return array
     */
    public function getTechnicienUser()
    {
        return $this->technicien;
    }

    /**
     * retourne les utilisateur qui audit
     * @return array
     */
    public function getAuditeurUser()
    {
        return $this->auditeur;
    }

    /**
     * retourne les utilisateur qui gere les entrée en stock
     * @return array
     */
    public function getInStockUser()
    {
        return $this->inStock;
    }

    /**
     * retourne les utilisateur commerciaux
     * @return array
     */
    public function getCommercialUser()
    {
        return $this->commercial;
    }

    /**
     * retourne tout les utilisateurs
     * @return array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * retourne tout les utilisateurs
     * @return array
     */
    public function getUsersDelais()
    {
        return $this->users;
    }

    /**
     * Loop pour detail utilisateurs ( NOM prenom ID )
     */
    public function getUserDetails($userId)
    {
            return  isset($this->users[$userId]) ? $this->users[$userId] : ['nom' => 0,'prenom'=>0,'id' => $userId,'unknow'=>1];
    }

    /**
     * nous retourn les mois du calendrier
     * @return array
     */
    public function getCalender()
    {
        return $this->calender;
    }

    /**
     * nous retourn les mois du calendrier minimal
     * @return array
     */
    public function getCalenderMin()
    {
        return $this->calenderMin;
    }

    /**FONCTiON DE RECHERCHE D'UN FORMAT DATe DANS UNE CHAINE DE CHAR
     * @param $research
     * @return mixed
     */
    public function DateSearch($research)
    {
        preg_match_all ("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,2})|",$research,$dtres);
        return $dtres;
    }

    /**FONCTiON DE RECHERCHE D'UN FORMAT TIME DANS UNE CHAINE DE CHAR
     * @param $research
     * @return mixed
     */
    public function TimeSearch($research)
    {
         preg_match_all ("|([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})|",$research,$timeres);
        return $timeres;
    }

    /**
     * Recherche Doublon dans un tableau
     * @param $table
     * @return bool
     */
    public function Doublon($table)
    {
        $doublons = false; // valeur pas défaut
        $freq = array_count_values($table);

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

    public function dateIntervale($date,$nbj)
    {
        $date = is_object($date) ? $date : new Carbon($date);
        $nbj--;
        $data['begin']=$date->format('Y-m-d');
        $data['end']= $nbj > 1 ? $date->copy()->addDays($nbj)->format('Y-m-d') : $date->copy()->addDay($nbj)->format('Y-m-d');

        return $data;
    }

    /**
     * nous donne le 1er et le dernier jour du JOUR en fonctionne de la date donné en argument.
     * @param $date
     * @return mixed
     */
    public function dateDay($date)
    {
        $date = is_object($date) ? $date : new Carbon($date);

        $data['begin']=$date->format('Y-m-d');
        $data['end']=$date->format('Y-m-d');

        return $data;
    }

    /**
     * nous donne le 1er et le dernier jour de la SEMAINE en fonctionne de la date donné en argument.
     * @param $date
     * @return mixed
     */
    public function dateWeek($date)
    {
        $date = is_object($date) ? $date : new Carbon($date);

        $data['begin']=$date->copy()->startOfWeek()->format('Y-m-d');
        $data['end']=$date->copy()->endOfWeek()->format('Y-m-d');

        return $data;
    }

    /**
     * nous donne le 1er et le dernier jour du MOIS en fonctionne de la date donné en argument.
     * @param $date
     * @return mixed
     */
    public function dateMonth($date)
    {
        $date = is_object($date) ? $date : new Carbon($date);

        $data['begin']=$date->copy()->startOfMonth()->format('Y-m-d');
        $data['end']=$date->copy()->endOfMonth()->format('Y-m-d');

        return $data;
    }

    /**
     * nous donne le 1er et le dernier jour de l'année en fonctionne de la date donné en argument.
     * @param $date
     * @return mixed
     */
    public function dateYear($date)
    {
        $date = is_object($date) ? $date : new Carbon($date);

        $data['begin']=$date->copy()->startOfYear()->format('Y-m-d');
        $data['end']=$date->copy()->endOfYear()->format('Y-m-d');

        return $data;
    }

    /**
     * Decompose une date ObjectCarbon
     * @param $date
     * @return mixed
     */
    public function decompose($date)
    {
        $this->test_jour = $date;

        if ($this->test_jour->dayOfWeek == Carbon::SUNDAY) {
            $array["jour"] = 'Dimanche';
        }

        if ($this->test_jour->dayOfWeek == Carbon::MONDAY) {
            $array["jour"] = 'Lundi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::TUESDAY) {
            $array["jour"] = 'Mardi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::WEDNESDAY) {
            $array["jour"] = 'Mercredi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::THURSDAY) {
            $array["jour"] = 'Jeudi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::FRIDAY) {
            $array["jour"] = 'Vendredi';
        }

        if ($this->test_jour->dayOfWeek == Carbon::SATURDAY) {
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

    /**
     * Numero du jour
     * @param $dti_
     * @return int
     */
    public function NumberOrder_($dti_){

        if ($dti_->dayOfWeek == carbon::MONDAY){
            $this->DayOrder = 1;
        } ;

        if ($dti_->dayOfWeek == carbon::TUESDAY){
            $this->DayOrder = 2;
        } ;

        if ($dti_->dayOfWeek == carbon::WEDNESDAY){
            $this->DayOrder = 3;
        } ;

        if ($dti_->dayOfWeek == carbon::THURSDAY){
            $this->DayOrder = 4;
        } ;

        if ($dti_->dayOfWeek == carbon::FRIDAY){
            $this->DayOrder = 5;
        } ;

        if ($dti_->dayOfWeek == carbon::SATURDAY){
            $this->DayOrder = 6;
        } ;

        if ($dti_->dayOfWeek == carbon::SUNDAY){
            $this->DayOrder = 7;
        } ;

        return $this->DayOrder;
    }

    /**
     * Jour Ouvrable
     * @param $dti_
     * @return array
     */
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

    /**
     * format un chiffre
     * @param $digit
     * @return string
     */
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

    /**
     * ??? Array Search
     * @param $array
     * @param $cols
     * @return array
     */
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

    /**
     * Evolution entre 2 valeur
     * @param $int
     * @return string
     */
    public function EVO($int){

        if( $int >= '-10000000' AND $int <= '-50'){ return '--'; }
        elseif($int >= '-50' AND $int <= '-4'){ return '-';}
        elseif($int >=  '-3' AND $int <= '3'){ return '=';}
        elseif($int > '3' AND $int < '50'){ return '+';}
        elseif($int >= '50' AND $int < '500000'){ return '++';}
        else{ return 'x';}

    }


    /**
     * ???
     * @param $needle
     * @param $haystack
     * @param bool $match_all
     * @param $sub
     * @param bool $preg_mode
     * @return array|bool|int|string
     */
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


    /**
     * permet d'afficher une date lisible
     * @param $date
     * @param $option
     * @return string
     */
    public function dateLisible($date , $option='minWithNotYear')
    {
        $date = is_object($date) ? $date : new Carbon($date) ;

        if($option === 'minWithNotYear')
        {
            $day = $date->day;
            $month = $this->getCalenderMin()[$date->month];
             return $date = $day.' '.$month ;
        }

        if($option === 'minWithYear')
        {
            $day = $date->day;
            $year = $date->year;
            $month = $this->getCalenderMin()[$date->month];
            return $date = $day.' '.$month.' '.$year ;
        }

        if($option === 'normalWithNotYear')
        {
            $day = $date->day;
            $j = $this->getDays($date);
            $year = $date->year;
            $month = $this->getCalender()[$date->month];
            return $date = $j.' '.$day.' '.$month ;
        }

    }

    public function getDays($date)
    {

        if($date->dayOfWeek == Carbon::SUNDAY) return 'Dimanche';
        if($date->dayOfWeek == Carbon::MONDAY) return 'Lundi';
        if($date->dayOfWeek == Carbon::TUESDAY) return 'Mardi';
        if($date->dayOfWeek == Carbon::WEDNESDAY) return 'Mercredi';
        if($date->dayOfWeek == Carbon::THURSDAY) return 'Jeudi';
        if($date->dayOfWeek == Carbon::FRIDAY) return 'Vendredi';
        if($date->dayOfWeek == Carbon::SATURDAY) return 'Samedi';
    }


    public function getTag ($item)
    {
        $tags = [];
        foreach (collect($this->getCategorieDB()) as $index => $tag)
        {
            if($item->$tag === 1)
            {
                $tags[$tag] =[
                    'tag' => $tag,
                    'color' => 'tag_color_'.$tag,
                    'abbr' => strtoupper( substr($tag,0,2)),
                    'fullName' =>$this->getCategorieGlobal()[$tag] ,
                ];
            }
        }

        return $tags;
    }

    public function cleanGestionObject()
    {
        unset($this->prestationMin);
        unset($this->prestation);
        unset($this->categorie);
        unset($this->categorieDB);
        unset($this->categorieMin);
        unset($this->technicien);
        unset($this->auditeur);
        unset($this->inStock);
        unset($this->commercial);
        unset($this->calender);
        unset($this->calenderMin);
        unset($this->middleware);
        unset($this->validatesRequestErrorBag);
    }

} 