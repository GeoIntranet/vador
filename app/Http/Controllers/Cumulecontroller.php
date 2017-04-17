<?php

namespace App\Http\Controllers;

use App\Horaire;
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
use kint;
class CumuleController extends Controller {


    function __construct(){

        $this->middleware('auth');
        $this->middleware('RegisterRoute');
        $this->middleware('DispatcherRoutes');
        $this->middleware('Location');

        $this->cg = new Lib\CumuleGestion();
        $this->h = new Horaire();
        $this->Cumule = new Cumule();


    }

    public function FaireUnCumule($id,$s){

        $u = $this->U->find($id);

        if($u <> null){
            $last = $this->cumule->lastCumule($id);

            if($last <> null){
                $dtStart = $last->CUMULE_dt;
                $dtEnd =$this->today->copy()->format('Y-m-d');

                var_dump($dtStart);
                var_dump($dtEnd);
            }

        }


    }

    public function Cumule($id,$forceCumule) {


        /***
         *  LOGIQUE CREATION CUMULE
         * ? Init ? -> redirect sur page pour init
         * ? recherche dernier cumule ?
         * ? a jour ? oui ->redirect
         * //
         * ? recherche les horaire dans l'intervalle lundi - vendredi
         * + Calcule < > Prestation / Rec / HP / HNP / CP /CP2 / EF
         * + record du cumule
         * - On recommence cette boucle jusqu'a etre a jour
         *
         *
         *
         */

        $cumule = $this->cg->hasCumule($id);

//        var_dump($cumule);
//        var_dump($id);

        if( $cumule <> FALSE){

            $i=1;

            if($this->cg->hasLVL($id,$forceCumule) == FALSE){

                $dt = new Carbon($cumule->CUMULE_dt);
                $dtNext = ($forceCumule == 0 ) ? $this->cg->getLastDtCT() :$this->cg->getLastDtCT()->copy()->addWeek(1);

                $HoraireSemaine = collect( $this->h->getHoraireInt( $id,$dt->format('Y-m-d'),$dtNext->format('Y-m-d') ) );
                $formathoraireSemaine = $HoraireSemaine->chunk(5);

                $resumeHoraire=[];
                //chaque semaine
                //var_dump($formathoraireSemaine[0]);
                foreach ($formathoraireSemaine as $k => $v) {

                    //var_dump($formathoraireSemaine[$k]->first());

                    $complete = $this->cg->CompleteSemaine($v);

                    if( $complete == TRUE){

                        $v = collect($v);
                        $first = new carbon($v->last()->date_r);
                        $first = $first->addDays(2);

                        $this->cg->resetPresta();

                        //chaque jour de la semaine
                        foreach ($v as $kk => $vv) {

                            $ordernumDay = new Carbon($vv->date_r);
                            $kk = $ordernumDay->dayOfWeek;

                            $balanceMinutage = ($kk == 5) ? 420 : 480 ;
                            $H = $this->cg->hm($vv->heures_taff);
                            
                            if($vv->cp == 1)$this->cg->setH( $this->cg->getH()+ $H + $balanceMinutage );
                            if($vv->cp2 == 1) $this->cg->setH( $this->cg->getH() + 240 );
                            if($vv->ef == 1) $this->cg->setH( $this->cg->getH()+ $H + $balanceMinutage );;

                            $H = $H+ $this->cg->getH();
                            $this->cg->setH($H);

                            $cp = $vv->cp + $vv->cp2/2;
                            $cp = $cp+ $this->cg->getCp();
                            $this->cg->setCp($cp);

                            $ef = $vv->ef;
                            $ef = $ef+ $this->cg->getEf();
                            $this->cg->setEf($ef);

                            if($vv->recup == 1){
                                $rec = $this->cg->hm($vv->heures_taff)-$balanceMinutage;
                                $rec = $rec+ $this->cg->getRec();
                                $this->cg->setRec($rec);
                                $this->cg->setH($this->cg->getH());
                            }



                            if($vv->heure_paye == 1){
                                $hp = $this->cg->hm($vv->heures_taff)-$balanceMinutage;
                                $hp = $hp+ $this->cg->getHp();
                                $this->cg->setHp($hp);
                                $this->cg->setH($this->cg->getH());
                                
                            }

                            if($vv->hnp == 1){
                                $hnp = $this->cg->hm($vv->heures_taff)-$balanceMinutage;
                                //var_dump($vv->date_r);
                                $hnp = $hnp+ $this->cg->getHnp();
                                $this->cg->setHnp($hnp);
                                $this->cg->setH($this->cg->getH());
                            }
                               
                            $dt = new Carbon($vv->date_r);
                            $resumeHoraire[$k]['DT']=$dt->endOfWeek()->format('Y-m-d');
                            $resumeHoraire[$k]['H']=2340;
                            $resumeHoraire[$k]['HT']=$this->cg->getH();
                            $resumeHoraire[$k]['DIF']=$this->cg->getH()-2340;

                            $resumeHoraire[$k]['REC']=$this->cg->getRec();
                            $resumeHoraire[$k]['HP']=$this->cg->getHp();
                            $resumeHoraire[$k]['HNP']=$this->cg->getHnp();
                            $resumeHoraire[$k]['CUM']=$this->cg->getHnp() + $this->cg->getHp()+$this->cg->getRec();

                            $resumeHoraire[$k]['CP']=$this->cg->getCp();
                            $resumeHoraire[$k]['EF']=$this->cg->getEf();
                        }

                    }
                    else{
//                        var_dump('semaine INCOMPLETE');
//                        var_dump($v);
                    }
                }

                foreach ($resumeHoraire as $kr => $vr) {
                    $majRec= 0;
                    $majHp= 0;
                    $h4_ = 240;

                    $s = $vr['HT'] ;
                    $hp = $vr['HP'];
                    $rec = $vr['REC'];
                    $tot = $s+$hp+$rec;

                    /**
                     * Calcule de la majoration
                     */
                    if($vr['HT'] > 2580){
                       
                        if( $rec >= $h4_){


                            $majRec = ( ($h4_*25)/100) + ((($h4_-$rec)*50)/100);
                            $majHp = ($majHp *50)/100;
                            
                            $resumeHoraire[$kr]['mRec']=$majRec;
                            $resumeHoraire[$kr]['mHp']=$majHp;
                        }
                        else{

                            $majRec = ($rec *25)/100;
                            $majHp = ( ( ($h4_ - $rec)*25)/100 )  + ( (($hp-$h4_ )*50) /100 );

                            $resumeHoraire[$kr]['mRec']=$majRec;
                            $resumeHoraire[$kr]['mHp']=$majHp;
                        }

                    }
                    else{
                      
                        $majRec =($rec > 0) ?( ($rec*25)/100) :0 ;
                        $majHp = ($hp > 0) ? ($hp*25)/100 : 0;

                        $resumeHoraire[$kr]['mRec']=$majRec;
                        $resumeHoraire[$kr]['mHp']=$majHp;
                    }

                    $dtNOW = new carbon($resumeHoraire[$kr]['DT']);
                    $dtPREVIOUS = $dtNOW->copy()->subweek(1);
                    $soldeDtPrev[$dtNOW->format('Y-m-d')]=[
                        'dtPREVIOUS' => $dtPREVIOUS,
                        'dtNOW' => $dtNOW,
                    ];

                }

                foreach ($resumeHoraire as $k => $v) {

                    $soldeDtPrev_ =$soldeDtPrev[$v['DT']]['dtPREVIOUS']->format('Y-m-d');
                    $solde = $this->Cumule->presentCumule($id,$soldeDtPrev_);


                    $recPrev = ($solde <> FALSE) ? $solde->CUMULE_rec_solde : 0;
                    $hpPrev = ($solde <> FALSE) ? $solde->CUMULE_hp_solde : 0;
                    $hnpPrev = ($solde <> FALSE) ? $solde->CUMULE_hnp_solde : 0;
                    $cpPrev = ($solde <> FALSE) ? $solde->CUMULE_cp_solde : 0;
                    $efPrev = ($solde <> FALSE) ? $solde->CUMULE_ef_solde : 0;
                    

                    $data['CUMULE_user']=$id;
                    $data['CUMULE_dt']=$soldeDtPrev[$v['DT']]['dtNOW']->format('Y-m-d');

                    $data['CUMULE_rec']=$v['REC'];
                    $data['CUMULE_rec_maj']=$v['mRec'];
                    $data['CUMULE_hp']=$v['HP'];
                    $data['CUMULE_hp_maj']=$v['mHp'];
                    $data['CUMULE_hnp']=$v['HNP'];
                    $data['CUMULE_cp']=$v['CP'];
                    $data['CUMULE_ef']=$v['EF'];

                    $data['CUMULE_rec_solde']=$v['REC']+$recPrev+$v['mRec'];
                    $data['CUMULE_hp_solde']=$v['HP']+$hpPrev+$v['mHp'];
                    $data['CUMULE_hnp_solde']=$v['HNP']+$hnpPrev;
                    $data['CUMULE_cp_solde']=$cpPrev-$v['CP'];
                    $data['CUMULE_ef_solde']=$efPrev-$v['EF'];
                    Cumule::create($data);

                }

            }
            else{
//                var_dump('REDIRECT');
                //On est a jour on redirect !
            }
        }
        else{
            var_dump('user pas initialiser !');
            //redirect page creation init .
        }

    }

    public function AutoCumuleUsers(Request $request){

        $users = $this->h->getUserDistinct();

        foreach ($users as $user) {

            $this->Cumule($user,1);

        }

        $request->session()->flash('AutoCumule','Le calcule des soldes a bien été réaliser');

        return Redirect::back();
    }









}
