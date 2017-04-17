<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Gestion;
use App\Http\Controllers\Lib\Stat\StatUserGestion;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatController extends Gestion
{

    protected $statUserGestion;
    protected $user;
    protected $month;
    protected $moyenne;
    protected $commandList;

    protected $i;

    /**
     * StatController constructor.
     */
    public function __construct(StatUserGestion $statUserGestion, User $user)
    {
        $this->statUserGestion = $statUserGestion;
        $this->user= [];
        $this->month =[];
        $this->moyenne =[];
        $this->user= $user;
        $this->i = 0;
    }

    public function general(Request $request)
    {
        return view('stat.general')->with('request',$request);
    }
    /**
     * permet de controller la logique selon si plusieur user ou unique user
     * @param Request $request
     * @param $user
     * @param $year
     * @return mixed
     */
    public function disptachJob(Request $request ,$job ,$user ,$year)
    {

        if( $job === 'preparation' )
        {
            return $user ==='all' ? $this->commandAll($request ,$user ,$year) : $this->commandUser($request ,$user ,$year);
        }

        if( $job === 'incident' )
        {
            return $user ==='all' ? $this->incidentAll($request ,$user ,$year) : $this->incidentUser($request ,$user ,$year);
        }

    }


    /**
     * retourne le nombre de commande prépare par un utilisateur /mois sur une année
     * @param Request $request
     * @param $user
     * @param $year
     * @return mixed
     */
    public function commandAll(Request $request ,$user ,$year)
    {

        $this->statUserGestion->initOption($user,$year,$this->getTechnicienUser());

        $option = $this->statUserGestion->getOption();
        $userContribution = $this->statUserGestion->contribution($option,$option['user']);
        $this->statUserGestion->byMonth($userContribution);
        $nombreCommandeYear = $this->statUserGestion->commandes($option)->count();

        $moyenne = [];

        foreach ( $this->calender as $km => $month) {
            $moyenne[$km]=0;
            foreach ($option['user'] as $user) {
                $detailYear = $this->statUserGestion->getDetailYear();
                $moyenne[$km]= $this->statUserGestion->presenceData($user, $km) ? $moyenne[$km] + count($detailYear[$user][$km]): $moyenne[$km];
            }
            $moyenne[$km] = round($moyenne[$km]/(count($option['user']))) ;
        }

        return view('stat.tech.commandAll')
            -> with('request',$request)
            -> with('detail',$this->statUserGestion->getDetailYear())
            -> with('month',$this->month)
            -> with('users',$option['user'])
            -> with('moyenne',$moyenne)
            -> with('total',array_sum($moyenne))
            -> with('nombreCommandeYear',$nombreCommandeYear)
            ;

    }

    /**
     * Details des commande preparer pour un utilisateur donné
     * @param Request $request
     * @param $user
     * @param $year
     * @return mixed
     */
    public function commandUser(Request $request ,$user , $year)
    {

        $this->statUserGestion->initOption($user,$year,$this->getTechnicienUser());
        $option = $this->statUserGestion->getOption();

        $userContribution = $this->statUserGestion->contribution($option,$option['user']);
        $numberItem_=$this->statUserGestion->sortie($option)->count();


        $userDetail= [];
        $numberItemMonth=[];
        $numberCommandMonth=[];
        $moyenneItemCommand=0;
        $numberCommand=0;
        $numberItem=[];


        foreach ($userContribution as $item => $value) {

            $month = $value->out_datetime->month;
            $id = $value->id_locator;
            $date = $this->dateLisible($value->out_datetime,'minWithNotYear');
            $cmd = $value->out_id_cmd;

            if($this->statUserGestion->validFormatCommand($cmd))
            {
                $userDetail[$month][$cmd][$id]=$date;
                $numberCommandMonth[$month]=count($userDetail[$month]);
                $numberItem[$month][$cmd]= count($userDetail[$month][$cmd]);

            }

        }
        $moyenneItemCommand = round($numberItem_/array_sum ( $numberCommandMonth ));
        $this->statUserGestion->byMonth($userContribution);


        return view('stat.tech.commandUser')
            -> with('request',$request)
            -> with('detail',$userDetail)
            -> with('commandByMonth',$numberCommandMonth)
            -> with('moyenneItemByCommand',$moyenneItemCommand)
            -> with('commandYear',array_sum ( $numberCommandMonth ))
            -> with('numberItem',$numberItem_)
            -> with('month',$this->month)
            -> with('users',$option['user'])
            ;
    }


    public function incidentAll(Request $request ,$user ,$year)
    {
        $this->statUserGestion->initOption($user,$year,$this->getTechnicienUser());
        $option = $this->statUserGestion->getOption();
        $this->statUserGestion->searchParticipation($option,$this->getUsers());
        $participation = $this->statUserGestion->getDetailIncidentYear();
        $this->statUserGestion->calculeMoyenne($participation,$this->getTechnicienUser(),$this->getCalender());
        $moyenne = $this->statUserGestion->getMoyenneIncidentYear();

        return view('stat.tech.incidentAll')
            -> with('request',$request)
            -> with('users',$option['user'])
            -> with('moyenne',$moyenne)
            -> with('participation',$participation)
            ;
    }

    public function incidentUser(Request $request ,$user ,$year)
    {
        $this->statUserGestion->initOption($user,$year,$this->getTechnicienUser());
        $option = $this->statUserGestion->getOption();
        $this->statUserGestion->searchParticipation($option,$this->getUsers());
        $participation = $this->statUserGestion->getDetailIncidentYear();
        $this->statUserGestion->calculeMoyenne($participation,$this->getTechnicienUser(),$this->getCalender());
        $moyenne = $this->statUserGestion->getMoyenneIncidentYear();

        return view('stat.tech.incidentUser')
            -> with('request',$request)
            -> with('users',$option['user'])
            -> with('moyenne',$moyenne)
            -> with('participation',$participation)
            ;
    }
}
