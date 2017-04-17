<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 06/03/2016
 * Time: 16:56
 */

namespace App\Http\Controllers\Lib\Display;
use App\Http\Controllers\Lib\Board\Module\ArriveModule;
use App\Http\Controllers\Lib\Board\Module\IncidentModule;
use App\Http\Controllers\Lib\Gestion;
use App\Incident as Incident;
use App\Achat as Achat;
use App\Information as Information;
use App\Commande as Commande;

use App\Stock;
use DB;
use Carbon\Carbon;

class DisplayGestion extends Gestion {

    public $user;
    public $template;
    public $config;
    public $hasConfig;
    public $module;
    public $moduleContent;
    public $moduleData;
    public $moduleMaintenance;
    public $default;
    public $dt;
    public $incidentNew;
    public $incidentActifUser;
    public $incidentOpen;
    public $anniversaireUser;

    public $CommandesEnCours;

    public $lastIncident;
    public $nonLuIncident;
    public $actifIncident;

    //MODEL_________________________________________________
    public $Achat;
    public $Incident;
    public $Locator;
    public $Information;
    public $Commandes;


    const locator_emplacements = 1;
    const locator_machines = 2;

    public function __Construct(){

        $this->Achat= new Achat();
        $this->Incident= new Incident();
        $this->Locator= new Stock();
        $this->Information= new Information();
        $this->Commandes= new Commande();


        $this->dt= New Carbon();

        $this->anniversaireUser=[];

        $this->module=[
            'mAchat',
            'mArrive',
            'mCrm',
            'mDelai',
            'mIncident',
            'mLocator',
            'mInfo',
        ];
        $this->moduleContent=[
            'cRapidsearch',
            'cNews',
            'cFav',
            'cGoogle',
        ];

        $this->default=[
            'id' => 'DEFAULT',
            'TEMPLATE_id' =>'1' ,
            'TEMPLATE_M1' =>'mIncident' ,
            'TEMPLATE_M1_mode' =>'1' ,
            'TEMPLATE_M2' =>'mContent' ,
            'TEMPLATE_M2_mode' =>'1' ,
            'TEMPLATE_M3' =>'mArrive' ,
            'TEMPLATE_M3_mode' =>'1' ,
            'TEMPLATE_M4' =>'mInfo' ,
            'TEMPLATE_M4_mode' =>'1' ,
            'TEMPLATE_M5' =>'mLocator' ,
            'TEMPLATE_M5_mode' =>'1' ,
            'TEMPLATE_M6' =>'mAchat' ,
            'TEMPLATE_M6_mode' =>'1' ,
            'TEMPLATE_M7' =>'mCrm' ,
            'TEMPLATE_M7_mode' =>'1' ,
            'TEMPLATE_M8' =>'none' ,
            'TEMPLATE_M8_mode' =>'none' ,
            'TEMPLATE_M9' =>'none' ,
            'TEMPLATE_M9_mode' =>'none' ,
            'TEMPLATE_M10' =>'none' ,
            'TEMPLATE_M10_mode' =>'none' ,
            'TEMPLATE_M11' =>'none' ,
            'TEMPLATE_M11_mode' =>'none' ,
            'TEMPLATE_rapidsearch' =>1 ,
            'TEMPLATE_google' =>1,
            'TEMPLATE_news' =>1 ,
            'TEMPLATE_news_mode' =>1 ,
            'TEMPLATE_fav' =>1,
            'TEMPLATE_fav_mode' =>1 ,
        ];

        $this->moduleData=[];
        $this->moduleMaintenance=[];

    }

    public function forUser($user){
        $this->user= $user;
    }

    public function GetModule(){
        return $this->module;
    }

    public function GetModuleContent(){
        return $this->moduleContent;
    }

    public function GetDefault(){ return $this->default; }

    public function GetIncidentNew(){ return $this->incidentNew; }
    public function GetIncidentActifUser(){ return $this->incidentActifUser; }

    public function GetIncidentOpen(){ return $this->incidentOpen; }
    public function SetIncidentOpen($var){  $this->incidentOpen = $var; }

    public function GetAnniversaireUser(){ return $this->anniversaireUser; }

    public function GetLastIncident(){ return $this->lastIncident; }
    public function SetLastIncident($var){  $this->lastIncident = $var; }

    public function SetActifIncidentUser($var){ $this->actifIncident = $var; }
    public function GetActifIncidentUser(){ return $this->actifIncident;  }

    public function GetNonLuIncident(){  return $this->nonLuIncident; }
    public function SetNonLuIncident($var){  $this->nonLuIncident = $var ; }

    public function SetCommandesEnCours($var){ $this->CommandesEnCours = $var;}
    public function GetCommandesEnCours(){return $this->CommandesEnCours;}



    public function GetModuleData($moduleName,$opt=FALSE){


        if($moduleName === 'mAchat'){
            // INIT DU MODUL ACHAT A VIDE
                //$this->moduleData['mAchat'][]=[ ];

            //On recupere les 5 derniere action des DA
                $dtAction = $this->Achat->LastActionDA();
                $lastDA = collect($dtAction);
                $id_pd = $lastDA->keys()->toArray();



            // On recupere les information des DA dans le tableau
            $listDa = $this->Achat->listDa($id_pd);
            

            $PD = collect($listDa);
            $ref=[];
            foreach ($listDa as $k => $v) { $ref[]=$v->ref; }

            //On recupere les information des articles de la liste de DA dans le tableau
            $daArticles = $this->Achat->daArticles($ref);


            //On finalise tout dans un array exploitable
            foreach ($listDa as $k => $v) {

                $daArt = isset($daArticles[$v->ref]) ? $daArticles[$v->ref] : 'Inconnu';
                $this->moduleData['mAchat'][]=[
                    'id' =>$v->id_pd,
                    'ref' => substr($v->ref,0,5),
                    'description' => substr($daArt,0,10),
                    'tool' =>  $daArt,
                    'dt' => $dtAction[$v->id_pd],
                ];
            }


            if( !is_null($id_pd) OR !empty($id_pd)){


            }


            return $this;

        }

        elseif($moduleName === 'mIncident')
        {
            $data = (new IncidentModule($this->Incident))->handle();
            $this->moduleData['mIncident']=$data;
            return $this;
        }

        elseif($moduleName === 'mArrive')
        {
            $data = (new ArriveModule($this->Locator))->handle();
            $this->moduleData['mArrive']=$data;
            return $this;
        }

        elseif($moduleName === 'mInfo'){

            //ANNIVERSAIRE
            $dtAnniversair = $this->dt->copy()->format('m-d');
            $anniversaire = $this->Information->dtAnniversaire();

            foreach ($anniversaire as $k => $v) {
                $dtAnn = substr($v->USER_datenais,5,5);

                if($dtAnniversair == $dtAnn){
                    $this->anniversaireUser=[
                        'nom' => $v->USER_nom,
                        'prenom' => $v->USER_prenom,
                    ];
                }
            }

            $audit = $this->Locator->auditCount();

            $incidentOuvert = $this->GetIncidentOpen();

            $Absent = $this->Information->Absent();

            //Fiche Exped
            //LUNDI == 1
            $vendredi = FALSE;
            $DtCopy = $this->dt->copy();

            if( $this->dt->dayOfWeek == 1 ) { $DtCopy->subDays(3); $vendredi = TRUE;}
            elseif($this->dt->dayOfWeek == 7){ $DtCopy->subDays(2); $vendredi = TRUE;}
            else{ $DtCopy->subDay(1); }



            $expedition = $this->Commandes->expedie($DtCopy->format('Y-m-d'));
            $enCours = !is_null( $this->GetCommandesEnCours() )? $this->GetCommandesEnCours(): $this->Commandes->enCours();



            $this->moduleData['mInfo']=[
                'V' => $vendredi,
                'audit' => $audit,
                'incidentO' => $incidentOuvert,
                'ABS' => $Absent,
                'exp' => $expedition,
                'enc' => $enCours
            ];
            return $this;

        }

        elseif($moduleName === 'mDelai'){
            $this->moduleData['mDelai']=null;

            return $this;
        }

        elseif($moduleName === 'mCrm'){

            $this->moduleMaintenance['Crm']= FALSE;
            $maintenance = FALSE;

            $LastAct = DB::connection('euro')
                ->table('crm_action')
                ->leftJoin('client', 'crm_action.id_client', '=', 'client.id_client')
                ->select('crm_action.id_client','crm_action.type_action','crm_action.info','crm_action.creat','client.nsoc','crm_action.id_client')
                ->orderBy('creat','DESC')
                ->take(5)
                ->get()
            ;



            if( is_null($LastAct) OR empty($LastAct) OR $LastAct == '' OR $LastAct == FALSE OR $maintenance == TRUE){
                //$this->moduleData['mCrm'][]= NULL;
                $this->moduleMaintenance['mCrm']= TRUE;

            }
            else{
                foreach ($LastAct as $k => $v) {
                    $this->moduleData['mCrm'][]=
                        [
                        'client' => substr($v->nsoc,0,15),
                        'TA' => $v->type_action,
                        'info' =>  substr ( strip_tags ( $v->info ),0,80),
                        'infoT' =>  substr ( strip_tags ( $v->info ),0,800),
                        'dt' => $v->creat,
                    ];
                }
            }

            return $this;
        }

        elseif($moduleName === 'mLocator'){


            $favoritLocatorEmplacements = $this->Locator->emplacementFavoris($this->user);
            $favoritLocatorMachines = $this->Locator->machineFavoris($this->user);

            $locatorEmplacement = !empty($favoritLocatorEmplacements[0]) ? $favoritLocatorEmplacements[0] : False;
            $locatorMachine = !empty($favoritLocatorMachines[0]) ? $favoritLocatorMachines[0] : False;


            $machines = explode("_", $locatorMachine);
            $emplacements = explode("_", $locatorEmplacement);

            $this->moduleData['mLocator']['emplacements']= collect($emplacements);
            $this->moduleData['mLocator']['machines']= collect($machines);

            return $this;
        }

        elseif($moduleName === 'mContent'){
            $this->moduleData['mContent']=null;

            return $this;
        }

        else{

        }

    }

    public function ReturnDisplay(){ return $this->moduleData; }
    public function ReturnMaintenance(){ return $this->moduleMaintenance; }




} 