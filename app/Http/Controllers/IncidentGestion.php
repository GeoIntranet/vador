<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 10/02/2016
 * Time: 11:37
 */
namespace App\Http\Controllers;

use Carbon\Carbon;

class IncidentGestion extends Gestion{

    public $Attribute;
    public $NameException;

    public $Now;
    public $Date;
    public $DateTime;
    public $Time;

    public $UserSource;
    public $UserTarget;

    public  $Content;

    public function __Construct(){

        $this->Now = Carbon::now();
        $this->Date = $this->Now->copy()->format('Y-m-d');
        $this->Time = $this->Now->copy()->format('h:i:s');
        $this->DateTime = $this->Now->copy()->format('Y-m-d h:i:s');

        $this->UserSource = 'ADMIN';
        $this->UserTarget = 'ADMIN';
        $this->Content = '';

        $this->Attribute=[
            'Appel/Dossier passé à' => 1,
            'A rappeler par'=> 2,
            'Attente D\'info du client'=> 3,
            'Retour matos NEUF (Suite Err)'=> 4,
            'Expedition Pièces/Machines'=> 5,
            'Attente Pièces/Machines du client'=> 6,
            'Demande de réparation/inter'=> 7,
            'Attente Fournisseur'=> 8,
            'Cloture de l\'incident'=> 9,
            'Non attribué'=> 10,
            'Demande de réparation' => 11,
            'Demande d\'inter' => 12,
            'Bonjour,>> Urgence' => 13,
            'Appel/Dossier passÃ© Ã' => 14,
            'Attente PiÃƒÂ¨ces/Machines du client' => 15,
            'Expedition PiÃ¨ces/Machines' => 16,
            'A rappeller par... -->' => 17,
        ];
        $this->NameException=[
            'LE' => 'LE MOINE',
            'MOINE' => 'LE MOINE',
            'VD' => 'VD BRANDEN',
            'BRANDEN' => 'VD BRANDEN',
            'ACCAD' => 'ROHÉE',
        ];

    }


    /**
     * @return array
     */
    public function GetAttribut(){
        return $this->Attribute;
    }

    /**
     * @param $Content
     */
    public function Formater($Content){
    }

    /**
     * @return array
     */
    public function GetNameException(){
        return $this->NameException;
    }



    /**
     * @return mixed
     */
    public function GetDate(){ return $this->Date; }

    /**
     * @return mixed
     */
    public function GetTime(){ return $this->Time; }

    /**
     * @return mixed
     */
    public function GetDateTime(){ return $this->DateTime; }

    /**
     * @return string
     */
    public function GetContent(){ return $this->Content; }

    /**
     * @return int
     */
    public function GetUserSource_(){ return $this->UserSource;   }

    /**
     * @return int
     */
    public function GetUserTarget_(){ return $this->UserTarget; }

    /**
     * @param $dt
     */
    public function SetDate($dt){ $this->Date = $dt; }

    /**
     * @param $dt
     */
    public function SetTime($dt){ $this->Time = $dt; }

    /**
     * @param $dt
     */
    public function SetDateTime($dt){ $this->DateTime = $dt; }

    /**
     * @param $content
     */
    public function SetContent($content){ $this->Content = $content; }

    /**
     * @param $user
     */
    public function SetUserSource($user){ $this->UserSource = $user; }

    /**
     * @param $user
     */
    public function SetUserTarget($user){ $this->UserTarget = $user; }

    /**
     * @param $content
     * @return mixed
     */
    public function FindDate($content){

        $date = preg_match_all ("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{1,4})|",$content,$dtres);

        $dtres = strtr($dtres[0][0], "/", "-");
        $y = substr($dtres, 6, 4);
        $m = substr($dtres, 3, 2);
        $d = substr($dtres, 0, 2);
        $Date_ = $y.'-'.$m.'-'.$d;

        $this->SetDate($Date_);
        return $this->GetDate();


    }

    /**
     * @param $content
     * @return mixed
     */
    public function FindTime($content){

        $Time = preg_match_all ("|([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})|",$content,$timeres);
        $Time_ = $timeres[0][0];

        $this->SetTime($Time_);
        return $this->GetTime();

    }

    /**
     * @return mixed
     */
    public function FormateDateTime(){

        $this->SetDateTime($this->GetDate().' '.$this->GetTime());
        return $this->GetDateTime();

    }

    /**
     * @param $content
     * @return int
     */
    public function FindUserSource($content){

        $posFin1 = strpos($content, ']');
        $chaine2 = substr($content,0,$posFin1);
        $posFin1 = strrpos($chaine2, ' ');
        $lengh1 = strlen($chaine2);
        $search1 = -1*($lengh1-$posFin1)-1;
        $posFinesp1 = strrpos($chaine2,' ',$search1)+1;
        $finPos1 = $posFin1-$posFinesp1;

        $NOMS = substr($chaine2,$posFinesp1,$finPos1);

        if(isset($this->GetNameException()[$NOMS])){
            $NOMS = $this->GetNameException()[$NOMS];
        }

        if($NOMS == FALSE){
            $posFin1 = strpos($content, ')');
            $chaine2 = substr($content,0,$posFin1);
            $posFin1 = strrpos($chaine2, ' ');
            $lengh1 = strlen($chaine2);
            $search1 = -1*($lengh1-$posFin1)-1;
            $posFinesp1 = strrpos($chaine2,' ',$search1)+1;
            $finPos1 = $posFin1-$posFinesp1;
            $NOMS = substr($chaine2,$posFinesp1,$finPos1);

            if(isset($this->GetNameException()[$NOMS])){
                $NOMS = $this->GetNameException()[$NOMS];
            }
        }

        $this->SetUserSource($NOMS);
        return $this->GetUserSource_();
    }

    /**
     * @param $content
     * @return int
     */
    public function FindUserTarget($content){


        $word =ltrim($content);
        $word =rtrim($word);
        $TestId= substr($word,-2,-1);
        //var_dump($TestId);

        if(is_numeric($TestId) == TRUE){
            //INCIDENT RECENT

            $posFin = strrpos($word, ' ');
            $chaine = substr($word,0,$posFin);
            $lengh = strlen($chaine);
            $search = -1*($lengh-$posFin)-1;
            $posFinesp = strrpos($chaine,' ',$search)+1;
            $finPos = $posFin-$posFinesp;
            $NOMT = substr($chaine,$posFinesp,$finPos);
            $NOMT = ltrim($NOMT);
            $NOMT = rtrim($NOMT);
            //var_dump($NOMT);
        }
        else{
            //VIELLE INCIDENT
            $posFin = strrpos($word, ' ');
//            var_dump($posFin);
            $lengh = strlen($word);
//            var_dump($lengh);
            //$chaine = substr($word,0,$posFin);
            $NOMT = substr($word,$posFin,$lengh);
            $NOMT = ltrim($NOMT);
            $NOMT = rtrim($NOMT);
//            var_dump($NOMT);
        }

        if(isset($this->GetNameException()[$NOMT])){
            $NOMT = $this->GetNameException()[$NOMT];
        }

//
        $this->SetUserTarget($NOMT);
        return $this->GetUserTarget_();
    }

    public function formatTel($telephone){

        $telephone = str_replace(' ','',$telephone);
        $telephone = str_replace('.','',$telephone);
        $telephone = chunk_split($telephone, 2, ' ');

        return $telephone;
    }

} 