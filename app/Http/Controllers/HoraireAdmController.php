<?php

namespace App\Http\Controllers;

use App\Http\controllers\Lib\Horaire\HoraireGestion;
use App\User;
use App\Cumule;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\LaravelDebugbar as debugbar_;
use App\Horaire;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use Mail;
use Auth;
use Validator;
use Input;
use Redirect;
use DB;
use PDF;

class HoraireAdmController extends Controller {

    public $h;
    public $hg;
    public $today;
    public $dataResume;
    public $user;

    protected $debug;

    function __construct(Request $request)
    {
//
//        $this->middleware('auth');
//        $this->middleware('RegisterRoute');
//        $this->middleware('DispatcherRoutes');
//        $this->middleware('Location');

        $debugbar = New debugbar_();
        $debugbar->disable();

        $this->h = New Horaire();
        $this->g = New Gestion();
        $this->today = new Carbon();
        $this->cgc = new CumuleController();
        $this->c = new Cumule();


        $this->dataResume = [];


        $this->Menu = New MenuGestion();
        $this->USER = new User();

        $this->userNFO = Auth::user();
        $this->user = Auth::user()->id;

        $this->Menu->initAuth($this->user);
        $this->mconf['avatar'] = $this->Menu->userIcone();
        $this->mconf['admin'] = ($this->Menu->isAdmin() == true) ? 'admin' : false;

        $this->hg = New HoraireGestion();

        if ($this->userNFO->USER_type < 6)
        {
            $request->session()->flash('noAdmin', 'Vous n\'avez pas les droits administrateurs pour acceder à cette section.');
            Redirect::to('dashboard')->send();
        }


    }

    public function getHoraireUser()
    {


        //var_dump($this->today);
        //var_dump($this->today->subweeks(5));
        $users = $this->h->getUserDistinct();
        $horaireUsers = $this->h->getHorraireUsers($users);
        $user_ = new User();

        $userNFO = collect($user_->UserNfo($users));
        $userNFO_ = [];
        foreach ($userNFO as $k => $v)
        {
            $userNFO_[ $v->USER_id ] = $v;
        }

        $Lundi = 1;
        $total = 5;

        $hh = [];

        foreach ($horaireUsers as $k => $v)
        {

            $hh[ $v->user ][ $v->date_r ] = [
                'id'   => $v->id,
                'u'    => $v->user,
                'dt'   => $v->date_r,
                'taff' => $v->heures_taff,
                'com'  => $v->com,
                'rec'  => $v->recup,
                'hp'   => $v->heure_paye,
                'cp'   => $v->cp,
                'cp2'  => $v->cp2,
                'ef'   => $v->ef,
                'hnp'  => $v->hnp,
            ];

        }

        $dtrr = ($this->today->dayOfWeek == 1) ? $this->today->copy()->subdays(2) : $this->today->copy()->subday(1);

        $decalageDay = $this->today->dayOfWeek;
        $miseNiveau = $decalageDay - $Lundi;
        $collectUser = [];
        $chunkUserHoraire = [];

        $Calendar_ = [];

        $firstC = $this->today->copy()->subWeeks(5);
        $lastC = $this->today;
        //var_dump($firstC);
        //var_dump($lastC);

        $numberFirstC = $firstC->dayOfWeek;
        $numberLastC = $lastC->dayOfWeek;
        //var_dump($numberFirstC);
        //var_dump($numberLastC);

        $differenceS = $numberFirstC - 1;
        $differenceE = 5 - $numberLastC;
        //var_dump($differenceE);
        //var_dump($difference);

        $DTSTART = ($differenceS > 1) ? $firstC->copy()->subDays($differenceS) : $firstC->copy()->subDay($differenceS);
        $DTEND = ($differenceE > 1) ? $lastC->copy()->addDays($differenceE) : $lastC->copy()->addDay($differenceE);
        $DTSTART->subDay(1);

        $diffInWeeks = $DTSTART->copy()->diffInWeeks($DTEND);

        //var_dump($DTSTART);
        //var_dump($DTEND);
        //var_dump($diffInWeeks);

        $semaine = $this->hg->getS();
        $int = [];

        $t = 1;
        while ($t <= $diffInWeeks + 1)
        {

            for ($x = 1; $x <= 5; $x ++)
            {
                if ($x == 1)
                {
                    $dt = $DTSTART->addDay(1);

                    $dtint = $dt->copy();
                    $int[ $t ][] = $dtint;

                    $dayOrder = $semaine[ $dt->dayOfWeek ];

                    $Calendar_[ $t ][ $x ] = [
                        'dt' => $DTSTART->format('Y-m-d'),
                        'd'  => $dayOrder
                    ];


                } elseif ($x == 5)
                {

                    $dt = $DTSTART->addDay(1);

                    $dtint = $dt->copy();
                    $int[ $t ][] = $dtint;
                    $dayOrder = $semaine[ $dt->dayOfWeek ];

                    $Calendar_[ $t ][ $x ] = [
                        'dt' => $DTSTART->format('Y-m-d'),
                        'd'  => $dayOrder
                    ];

                    $DTSTART->addDays(2);
                }
                else
                {
                    $dt = $DTSTART->addDay(1);
                    $dayOrder = $semaine[ $dt->dayOfWeek ];

                    $Calendar_[ $t ][ $x ] = [
                        'dt' => $DTSTART->format('Y-m-d'),
                        'd'  => $dayOrder
                    ];
                }
            }

            $t ++;
        }


        $Calendar_ = collect($Calendar_);
        //var_dump($Calendar_);
        //var_dump($int);
        //var_dump($hh);
        //var_dump($Calendar_->flatten());

        $horaireF = [];
        foreach ($Calendar_ as $kWeek => $vWeek)
        {
            foreach ($vWeek as $kDay => $vDay)
            {
                $vDay = $vDay['dt'];
                foreach ($users as $User)
                {
                    if ($User == 'xx')
                    {
                        var_dump($vDay);
                        var_dump(isset($hh[ $User ][ $vDay ]));
                    }
                    $dtr_ = $dtrr->format('Y-m-d');
                    $dtrr5 = $dtrr->copy()->subweeks(5)->addDay(1)->format('Y-m-d');

                    $dt = (isset($hh[ $User ][ $vDay ]['dt'])) ? $hh[ $User ][ $vDay ]['dt'] : $vDay;
                    $h = (isset($hh[ $User ][ $vDay ]['taff'])) ? $hh[ $User ][ $vDay ]['taff'] : false;
                    $id = (isset ($hh[ $User ][ $vDay ]['id'])) ? $hh[ $User ][ $vDay ]['id'] : false;
                    $cp = (isset($hh[ $User ][ $vDay ]['cp'])) ? $hh[ $User ][ $vDay ]['cp'] : false;
                    $cp2 = (isset($hh[ $User ][ $vDay ]['cp2'])) ? $hh[ $User ][ $vDay ]['cp2'] : false;
                    $hp = (isset($hh[ $User ][ $vDay ]['hp'])) ? $hh[ $User ][ $vDay ]['hp'] : false;
                    $rec = (isset($hh[ $User ][ $vDay ]['rec'])) ? $hh[ $User ][ $vDay ]['rec'] : false;
                    $ef = (isset($hh[ $User ][ $vDay ]['ef'])) ? $hh[ $User ][ $vDay ]['ef'] : false;
                    $hnp = (isset($hh[ $User ][ $vDay ]['hnp'])) ? $hh[ $User ][ $vDay ]['hnp'] : false;
                    $com = (isset($hh[ $User ][ $vDay ]['com'])) ? $hh[ $User ][ $vDay ]['com'] : '';
                    $r = (($vDay <= $dtr_) AND $vDay > $dtrr5) ? true : false;
                    $N = (($cp OR $cp2 OR $hp OR $rec OR $ef OR $hnp) <> 1) ? true : false;

                    $RE = (($vDay <= $dtr_) AND ($vDay > $dtrr5) AND ($id == false)) ? true : false;
                    $a = ($id <> false) ? true : false;

                    if ($User == 48 and $vDay == '2016-04-06')
                    {
                        //var_dump($vDay <= $dtr_);
                        //var_dump($vDay > $dtrr5);
                        //var_dump( $id == FALSE);
                    }

                    $ct = (isset($hh[ $User ][ $vDay ])) ? $hh[ $User ][ $vDay ] : 'NR';
                    $horaireF[ $User ][ $vDay ] = [
                        'id'          => $id,
                        'interval'    => $r,
                        'a'           => $a,
                        'RE'          => $RE,
                        'normalState' => $N,
                        'dt'          => $dt,
                        'h'           => $h,
                        'rec'         => $rec,
                        'hp'          => $hp,
                        'hnp'         => $hnp,
                        'cp'          => $cp,
                        'cp2'         => $cp2,
                        'ef'          => $ef,
                        'com'         => $com,
                    ];

                }
            }
        }

        //var_dump($horaireF[48]);
        $horaireFormat = collect($horaireF);
        $horaireFormat_ = [];

        foreach ($horaireF as $k => $h)
        {
            $horaireFormat[ $k ] = collect($h);
        }

        //var_dump($int);
        //var_dump($horaireFormat[48]['2016-04-06']);
        //var_dump(isset($hh[48]['2016-03-04']));

        return view('horaire.adminHoraire')
            ->with('h', $horaireFormat)
            ->with('today', $this->today)
            ->with('u', $userNFO_)
            ->with('calender', $Calendar_)
            ->with('int', $int)
            ->with('mconf', $this->mconf);
    }

    public function getEditHoraire($id, $user, $dt)
    {


        if ($id <> 0)
        {

            $horaireUser = Horaire::find($id);

            if ($horaireUser <> null)
            {

                $prestations = $this->hg->getPrestations();
                $dtToEdit = new Carbon($horaireUser->date_r);
                $planning = $this->hg->getPlanning();
                $numberOfDay = $dtToEdit->dayOfWeek;
                $timeToTaff = $planning[ $numberOfDay ];
                $decomposeNext = $this->g->decompose($dtToEdit);

                return view('horaire.adminEditHoraire')
                    ->with('presta', collect($prestations))
                    ->with('next', $dtToEdit)
                    ->with('id', $id)
                    ->with('dNext', $decomposeNext)
                    ->with('htaff', $timeToTaff)
                    ->with('user', 'x')
                    ->with('mconf', $this->mconf);
            } else
            {
                return Redirect::action('GEH', ['id' => 0, $user => $user, 'dt' => $dt]);
            }

        } else
        {

            $prestations = $this->hg->getPrestations();
            $dtToEdit = new Carbon($dt);

            $planning = $this->hg->getPlanning();
            $numberOfDay = $dtToEdit->dayOfWeek;
            $timeToTaff = $planning[ $numberOfDay ];
            $decomposeNext = $this->g->decompose($dtToEdit);

            return view('horaire.adminEditHoraire')
                ->with('presta', collect($prestations))
                ->with('next', $dtToEdit)
                ->with('dNext', $decomposeNext)
                ->with('htaff', $timeToTaff)
                ->with('user', $user)
                ->with('id', $id)
                ->with('mconf', $this->mconf);
        }

    }

    public function Store(Request $request)
    {

        var_dump(input::all());

        $input = [];
        $input['baseTravail'] = input::get('ht');
        $input['minuteBase'] = $this->hg->hm($input['baseTravail']);
        $input['h'] = (input::get('heure') == '') ? '00' : input::get('heure');
        $input['m'] = (input::get('minute') == '') ? '00' : input::get('minute');
        $input['presta'] = input::get('presta');
        $input['com'] = input::get('commentaire');
        $input['dtr'] = input::get('dtr');
        $input['userTravail'] = $input['h'] . ':' . $input['m'];
        $input['minuteUser'] = $this->hg->hm($input['userTravail']);
        $input['heureUserFormat'] = $this->hg->mh($input['minuteUser']);
        $user = input::get('u');


        $baseTravail = input::get('ht');
        $minuteBase = $this->hg->hm($baseTravail);

        $validation = false;
        $validation = $this->Validation($request, $input);


        if ($validation == false)
        {
            return redirect()->back()->withInput();
        } else
        {
            if (input::get('id') <> 'xx')
            {

                $this->update(input::get('id'));
                $data = $this->hg->getData();
                $dt = $this->cg->GetDtCumule($data['date_r']);

                $userID = Horaire::find(input::get('id'))->user;

                DB::table('Cumules')
                    ->where('CUMULE_dt', '>', $dt)
                    ->where('CUMULE_user', $userID)
                    ->delete();

                $this->cgc->Cumule($userID, 1);

                return redirect()->action('HoraireAdmController@getHoraireUser');
            } else
            {
                $data = $this->hg->getData();
                $dt = $this->cg->GetDtCumule($data['date_r']);

                $this->create($user);
                $this->cgc->Cumule($user, 1);

                return redirect()->action('HoraireAdmController@getHoraireUser');
            }
        }
    }

    public function Update($id)
    {

        $data = $this->hg->getData();

        $hp = (isset($data['heures_paye'])) ? $data['heures_paye'] : $data['heure_paye'];
        var_dump($hp);

        DB::table('horraires')
            ->where('id', $id)
            ->update([
                'heures_taff' => $data['heures_taff'],
                'com'         => $data['com'],
                'recup'       => $data['recup'],
                'heure_paye'  => $hp,
                'cp'          => $data['cp'],
                'cp2'         => $data['cp2'],
                'ef'          => $data['ef'],
                'hnp'         => $data['hnp'],
            ]);

    }

    public function Create($user)
    {

        $data = $this->hg->getData();
        $hp = (isset($data['heures_paye'])) ? $data['heures_paye'] : $data['heure_paye'];

        $h = new Horaire();
        $h->user = $user;
        $h->date_r = $data['date_r'];
        $h->heures_taff = $data['heures_taff'];
        $h->com = $data['com'];
        $h->recup = $data['recup'];
        $h->heure_paye = $hp;
        $h->cp = $data['cp'];
        $h->cp2 = $data['cp2'];
        $h->ef = $data['ef'];
        $h->hnp = $data['hnp'];
        $h->save();

    }

    public function Delete($id)
    {

        $dt = Horaire::find($id)->date_r;

        DB::table('Cumules')
            ->where('CUMULE_dt', '>', $dt)
            ->delete();

        DB::table('horraires')
            ->where('id', $id)
            ->delete();

        return Redirect::action('HoraireAdmController@getHoraireUser');
    }

    public function Validation(Request $request, $input)
    {


        $baseTravail = $input['baseTravail'];
        $minuteBase = $input['minuteBase'];
        $h = $input['h'];
        $m = $input['m'];
        $presta = $input['presta'];
        $com = $input['com'];
        $dtr = $input['dtr'];
        $userTravail = $input['userTravail'];
        $minuteUser = $input['minuteUser'];
        $heureUserFormat = $input['heureUserFormat'];


        $validation = true;

        if ($minuteUser > 1440)
        {
            $validation = false;
            $request->session()->flash('ClassWarningM', 'warning');
            $request->session()->flash('hToHigh', 'Vous ne pouvez pas travaillé plus de 24h par jour');
            $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
        }

        if ($minuteUser > $minuteBase)
        {


            if ($presta == 'cp' OR $presta == 'cp2' OR $presta == 'ef' OR $presta == 'hpn' OR $presta == 'n')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('errorPresta', 'Vous n\'avez pas choisit la bonne préstation.');
            }

            if ($presta == 'rec' OR $presta == 'hp')
            {

                if ($com == '')
                {
                    $validation = false;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('noMsg', 'Commentaire requis pour la validation du formulaire.');
                } else
                {

                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);

                }

            }

            if ($presta == '')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('noPresta', 'Vous avez fait plus d\'heures que prévu, choissisez une préstation.');

                if ($com == '')
                {
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                }

            }

        }

        if ($minuteUser == $minuteBase)
        {

            if ($presta <> '' AND $presta <> 'n')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('tooPresta', 'Aucune préstation requise lorsque vous faites des horaires normales.');
            } else
            {
                $this->hg->setDatadt($dtr)->setPrestation($presta)->setDataH($heureUserFormat);


            }


        }

        if ($minuteUser < $minuteBase)
        {

            //var_dump('heure USER inferieur a heure de base');
            if ($presta == 'cp' OR $presta == 'ef')
            {

                $this->hg
                    ->setPrestation($presta)
                    ->setDatacom($com)
                    ->setDatadt($dtr);

            }
            if ($presta == 'cp2')
            {
                if ($minuteUser <> 240)
                {
                    $validation = false;
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('errorHeure', 'Il faut que vous indiquiez 4h dans la case heures travaillé.');
                } else
                {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);


                }
            }
            if ($presta == 'hp')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('lowHeure', 'Vous n\'avez pas fait d\'heures supplémentaires');
            }
            if ($presta == 'n')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('lowHeure', 'Vous n\'avez pas fait d\'horaires normal');
            }
            if ($presta == 'rec')
            {

                if ($com == '')
                {
                    $validation = false;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('noMsg', 'Commentaire requis pour la validation du formulaire.');
                } else
                {

                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);

                }

            }
            if ($presta == 'hpn')
            {

                if ($com == '')
                {
                    $validation = false;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                } else
                {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);

                }
            }
            if ($presta == '')
            {
                $validation = false;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('noPresta', 'Vous avez fait moins d\'heures que prévu, choissisez une préstation.');

                if ($com == '')
                {
                    $validation = false;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                }

            }

        }

        //$validation = ($validation == TRUE) ? 'validation OK ' : 'validation ECHOUER';

        if ($validation == true)
        {

            $request->session()->flash('SucessHorraire', 'Votre horraire a bien été prit en compte ! ');

            return true;
        } else
        {

            return false;
            var_dump('LA VALIDATION A ECHOUER');

            return redirect()->action('HoraireController@index')
                ->withInput();
        }
    }

    public function QuePassa(Request $request)
    {


        $semaine = input::has('s') ? input::get('s') : 4;

        $users = $this->h->getUserDistinct();


        $usersNFO = $this->USER->UserNfo($users);

        $force = input::has('SA') ? input::get('SA') : 0;

        foreach ($usersNFO as $k => $v)
        {
            $usersNFO_TMP[ $v->USER_id ] = $v;
        }
        ksort($usersNFO_TMP);


        $dtEND = ($force == 1) ? $this->today->endOfWeek() : $this->today->endOfWeek()->subweek(1);
        $dtSTART = ($semaine > 1) ? $dtEND->copy()->subweeks($semaine)->addDay(1) : $dtEND->copy()->subweek($semaine)->addDay(1);


        $intCumule = $this->c->intervalleCumule($dtSTART, $dtEND);
        $horaires_ = $this->h->getHoraireInt($users, $dtSTART, $dtEND);

        $resume = [];
        $base = [];
        $userView = [];
        foreach ($intCumule as $kcu => $vcu)
        {
            $base[ $vcu->CUMULE_dt ] = new Carbon($vcu->CUMULE_dt);
            $resume[ $vcu->CUMULE_user ][ $vcu->CUMULE_dt ] = $vcu;
        }

        $solde = [];
        foreach ($usersNFO as $kuser => $vuser)
        {
            $soldeU = isset($resume[ $vuser->USER_id ]) ? collect($resume[ $vuser->USER_id ]) : collect(0);
            $solde[ $vuser->USER_id ] = $soldeU->last();
            $userView[ $vuser->USER_id ] = $vuser;

        }

        $resumeTMP = [];
        foreach ($resume as $kresume => $vresume)
        {
            if (isset($usersNFO_TMP[ $kresume ]->USER_nom))
            {
                $resumeTMP[ $usersNFO_TMP[ $kresume ]->USER_nom . '_' . $usersNFO_TMP[ $kresume ]->USER_id ] = $vresume;
            }

        }
        ksort($resumeTMP);

        $resumeF = [];
        foreach ($resumeTMP as $krt => $vrt)
        {
            $id = explode("_", $krt);
            $resumeF[ $id[1] ] = $vrt;
        }


        $this->dataResume['u'] = $userView;
        $this->dataResume['user'] = $users;
        $this->dataResume['base'] = $base;
        $this->dataResume['solde'] = $solde;
        $this->dataResume['r'] = $resumeF;
        $this->dataResume['hg'] = $this->hg;

        $request->session()->flash('dataResume', $this->dataResume);


        $view = view('horaire.cumuleResume');
        $view = $view->with('mconf', $this->mconf);
        $view = $view->with('u', $userView);
        $view = $view->with('base', $base);
        $view = $view->with('solde', $solde);
        $view = $view->with('r', $resumeF);
        $view = $view->with('hg', $this->hg);
        if (!empty(input::all()))
        {
            $view = $view->withInput(Input::all());
        }

        return $view;


    }

    public function QuePassaPDF(Request $request)
    {

        if (session::has('dataResume'))
        {

            $base = session::get('dataResume')['base'];
            $users = session::get('dataResume')['user'];

            //var_dump($base);
            $intSemaine = [];
            $intHoraireUser = [];
            foreach ($base as $kbase => $vbase)
            {
                $intSemaine[ $kbase ]['DEBUT'] = $vbase->copy()->subweek(1)->addDay(1);
                $intSemaine[ $kbase ]['FIN'] = $vbase->copy()->subDays(2);
                $HoraireUser_ = $this->h->getHoraireInt($users, $intSemaine[ $kbase ]['DEBUT'], $intSemaine[ $kbase ]['FIN']);

                $intHoraireUser[ $kbase ] = $HoraireUser_;
            }


            $fResum_ = [];

            foreach ($intHoraireUser as $kintsu => $vintsu)
            {
                foreach ($vintsu as $kk_ => $vv_)
                {
                    $fResum_[ $kintsu ][ $vv_->user ][] = $vv_;
                }
            }


            $dataResume['u'] = session::get('dataResume')['u'];
            $dataResume['user'] = session::get('dataResume')['user'];
            $dataResume['base'] = session::get('dataResume')['base'];
            $dataResume['solde'] = session::get('dataResume')['solde'];
            $dataResume['r'] = session::get('dataResume')['r'];
            $dataResume['hg'] = session::get('dataResume')['hg'];
            $dataResume['ints'] = $fResum_;
//            $dataResume['ints'] = $intHoraireUser;


            //var_dump($fResum_);
            $pdf = PDF::loadView('horaire.pdf.cumuleResume', $dataResume);

            return $pdf->stream('Resume_horaire.pdf');
        } else
        {
            return redirect()->route('cumulesResumes');
        }


        //$pdf = PDF::loadView('horaire.pdf.cumuleResume');
        //return $pdf->stream('invoice.pdf');
    }

    public function ReminderMail(Request $request)
    {

        $users = $this->USER->userListHoraire();
        $userNFO = $this->USER->UserNfo($users);

        $pasAjour = [];
        $data = [];

        foreach ($userNFO as $k => $v)
        {

            $today = new Carbon();
            $today->subday(1);
            $hg = new HoraireGestion($v->USER_id);
            $dateR = new Carbon($hg->ldtr()->date_r);
            $ref = $today->copy()->dayOfWeek;
            $dateB = ($ref == 0) ? $today->copy()->subDays(2)->format('Y-m-d') : $today->copy()->format('Y-m-d');
            $aJour = ($dateR->format('Y-m-d') >= $dateB ? true : false);

            if ($aJour !== true)
            {

                $data = [];
                Mail::send('emails.send', $data, function ($message)
                {
                    $message->from('test@test.test', 'Comptabilité Eurocomputer');
                    $message->to('geoffrey.valero@eurocomputer.fr')->subject('HORAIRES');
                });

                $pasAjour[ $v->USER_nom ] = [
                    'prenom' => $v->USER_prenom,
                    'email'  => $v->email
                ];
            }

        }

        $request->session()->flash('ReminderMail', $pasAjour);

        return Redirect::back();

    }

    public function getAbs()
    {
        return view('horaire.vacances.horaireVacances')->with('mconf', $this->mconf)->with('user', $this->user);
    }

    public function postAbs(Request $request)
    {


        $dtStart = $request->has('dt1') ? $request->get('dt1') : '';
        $dtEnd = $request->has('dt2') ? $request->get('dt2') : '';
        $prestation = $request->has('presta') ? $request->get('presta') : '';

        if ($dtEnd === '' OR $dtStart === '' OR $prestation === '')
        {
            $request->session()->flash('EmptyAbsInfo', 'Vous n\'avez pas remplie ls information necessaire pour votre demande d\'absence.');

            return redirect()->action('HoraireAdmController@getAbs')->withInput();
        } else
        {

            $com = [
                'i1'  => '08:15',
                'i2'  => '12:30',
                'i3'  => '14:00',
                'i4'  => '17:45',
                'iv1' => '09:00',
                'iv2' => '17:30',
                'cd'  => '08:15',
                'cm'  => '12:30',
                'cr'  => '14:00',
                'cf'  => '17:45',
                'cdv' => '09:00',
                'cfv' => '17:30',
            ];
            $tec = [
                'i1'  => '08:45',
                'i2'  => '12:30',
                'i3'  => '13:30',
                'i4'  => '17:45',
                'iv1' => '09:00',
                'iv2' => '14:00',
                'iv3' => '17:30',
                'td'  => '08:15',
                'tm'  => '12:30',
                'tr'  => '14:00',
                'tf'  => '17:45',
                'tdv' => '09:00',
                'tfv' => '17:30',
            ];

            $isT['com'] = [
                'i1'  => '08:15',
                'i2'  => '12:30',
                'i3'  => '14:00',
                'i4'  => '17:45',
                'iv1' => '09:00',
                'iv2' => '17:30',
                'd'   => '08:15',
                'm'   => '12:30',
                'r'   => '14:00',
                'f'   => '17:45',
                'dv'  => '09:00',
                'fv'  => '17:30',
            ];
            $isT['tec'] = [
                'i1'  => '08:45',
                'i2'  => '12:30',
                'i3'  => '13:30',
                'i4'  => '17:45',
                'iv1' => '09:00',
                'iv2' => '14:00',
                'iv3' => '17:30',
                'd'   => '08:45',
                'm'   => '12:30',
                'r'   => '13:30',
                'f'   => '17:45',
                'dv'  => '09:00',
                'fv'  => '17:30',
            ];


            $dtStart = new Carbon($dtStart);
            $dtEnd = new Carbon($dtEnd);
            $isCom = $this->userNFO->USER_t_com;
            $p = $this->userNFO->USER_t_com == 1 ? 'com' : 'tec';


            $diffGen = $dtStart->copy()->diffInHours($dtEnd);
            $diffDay = $dtStart->copy()->hour(0)->minute(0)->second(0)->diffInDays($dtEnd->copy()->hour(0)->minute(0)->second(0));

            $dtBASE = $dtStart->copy();
            $dtBASEF = $dtStart->copy();
            $base = 480;
            $int = 60;

            $j = 0;
            $h = 0;
            $m = 0;
            $dtABS = [];
            $i = 0;
            $minutesDiff = 0;

            while ($dtBASE <= $dtEnd)
            {
                $ON = $dtBASE->copy()->dayOfWeek;

                $dtBASE->hour(8)->minute(45);
                $dtBASEF->hour(17)->minute(45);

                if ($p == 'com') $dtBASE->minute(15);

                $mioumR = $p == 'com' ? $isT['com']['r'] : $isT['tec']['r'];
                $mioumR = $ON == 5 ? '14:00' : $mioumR;
                $mioum = '12:30';

                if ($ON == 5) $dtBASE->hour(9)->minute(0);
                if ($ON == 5) $dtBASEF->minute(30);
                $base = $ON == 5 ? 420 : 480;

                if ($p == 'com')
                {
                    $int = 90;
                } else
                {
                    $int = 60;
                    if ($ON == 5) $int = 90;
                }

                $debutU = $dtStart->copy()->format('G:i ');
                $debutR = $isT[ $p ]['d'];

                $hs = $dtStart->copy()->Format('a') == 'am' ? 'h' : 'H';
                $he = $dtEnd->copy()->Format('a') == 'am' ? 'h' : 'H';

                if ($ON == 5)
                {
                    $dtStart = ($dtStart->copy()->Format($hs . ':i') < $isT[ $p ]['d']) ? $dtStart->hour(substr($isT[ $p ]['dv'], 0, 2))->minute(substr($isT[ $p ]['dv'], 3, 2)) : $dtStart;
                } else
                {
                    $dtStart = ($dtStart->copy()->Format($hs . ':i') < $isT[ $p ]['d']) ? $dtStart->hour(substr($isT[ $p ]['d'], 0, 2))->minute(substr($isT[ $p ]['d'], 3, 2)) : $dtStart;
                }

                $dtStart = ($dtStart->copy()->Format($hs . ':i') > $isT[ $p ]['f']) ? $dtStart->hour($dtBASEF->copy()->Format($hs))->minute($dtBASEF->copy()->Format('i')) : $dtStart;
                $dtStart = (($dtStart->copy()->Format($hs . ':i') > $mioum) AND ($dtStart->copy()->Format($hs . ':i') < $mioumR)) ? $dtStart->hour(substr($mioumR, 0, 2))->minute(substr($mioumR, 3, 2)) : $dtStart;


                $dtEnd = ($dtEnd->copy()->Format($he . ':i') > $dtBASEF->copy()->Format('H:i')) ? $dtEnd->hour($dtBASEF->copy()->Format('H'))->minute($dtBASEF->copy()->Format('i')) : $dtEnd;
                $dtEnd = (($dtEnd->copy()->Format($he . ':i') > $mioum) AND ($dtEnd->copy()->Format($he . ':i') < $mioumR)) ? $dtEnd->hour(substr($mioum, 0, 2))->minute(substr($mioum, 3, 2)) : $dtEnd;


                if (($ON <> 6) AND ($ON <> 0) OR ($dtEnd < $dtStart))
                {


                    if ($dtEnd->copy()->format('Y-m-d') == $dtStart->copy()->format('Y-m-d'))
                    {


                        if ($dtStart->copy()->Format($hs . ':i') > $mioum)
                        {
                            $minutesDiff = $minutesDiff + $dtStart->diffInMinutes($dtEnd);

                            $dtABS[1] = ['d'   => $dtStart, 'f' => $dtEnd,
                                         'min' => $dtStart->diffInMinutes($dtEnd)
                            ];

                        } else
                        {
                            if ($dtEnd->copy()->Format($he . ':i') <= $mioum)
                            {
                                $minutesDiff = $minutesDiff + $dtStart->diffInMinutes($dtEnd);
                                $dtABS[1] = ['d'   => $dtStart, 'f' => $dtEnd,
                                             'min' => $dtStart->diffInMinutes($dtEnd)
                                ];
                            } else
                            {
                                $minutesDiff = $minutesDiff + $dtStart->diffInMinutes($dtEnd) - $int;
                                $dtABS[1] = ['d'   => $dtStart, 'f' => $dtEnd,
                                             'min' => $dtStart->diffInMinutes($dtEnd) - $int
                                ];
                            }
                        }
                    } else
                    {

                        if ($dtBASE->copy()->format('Y-m-d') == $dtStart->copy()->format('Y-m-d'))
                        {

                            if ($dtStart->copy()->Format($hs . ':i') > $mioum)
                            {
                                $minutesDiff = $minutesDiff + $dtStart->diffInMinutes($dtBASEF);

                                $dtABS[1] = ['d'   => $dtStart, 'f' => $dtBASEF->copy(),
                                             'min' => $dtStart->diffInMinutes($dtBASEF)
                                ];
                            } else
                            {
                                $minutesDiff = $minutesDiff + $dtStart->diffInMinutes($dtBASEF) - $int;
                                $dtABS[1] = ['d'   => $dtStart, 'f' => $dtBASEF->copy(),
                                             'min' => $dtStart->diffInMinutes($dtBASEF) - $int
                                ];
                            }
                        } elseif ($dtBASE->copy()->format('Y-m-d') == $dtEnd->copy()->format('Y-m-d'))
                        {


                            if ($dtEnd->copy()->Format($he . ':i') < $mioum)
                            {
                                $minutesDiff = $minutesDiff + $dtBASE->diffInMinutes($dtEnd);

                                $dtABS[] = ['d'   => $dtBASE->copy(), 'f' => $dtEnd,
                                            'min' => $dtBASE->diffInMinutes($dtEnd)
                                ];
                            } else
                            {
                                $minutesDiff = $minutesDiff + $dtBASE->diffInMinutes($dtEnd) - $int;

                                $dtABS[] = ['d'   => $dtBASE->copy(), 'f' => $dtEnd,
                                            'min' => $dtBASE->diffInMinutes($dtEnd) - $int
                                ];
                            }
                        } else
                        {

                            $dtABS[] = ['d'   => $dtBASE->copy(), 'f' => $dtBASEF->copy(),
                                        'min' => $base
                            ];
                            $minutesDiff = $minutesDiff + $base;
                        }
                    }
                }

                $dtBASE->addDay(1);
                $dtBASEF->addDay(1);
                $i ++;
            }

            $cumule = Cumule::where('CUMULE_user', $this->user)->lastCumule();

            $dd['solde'] = $cumule;
            $dd['user'] = $this->userNFO;
            $dd['m'] = $minutesDiff;
            $dd['dt'] = $dtABS;
            $dd['hg'] = new HoraireGestion($this->user);
            $dd['g'] = new Gestion();
            $dd['presta'] = $request->input('presta');
            $dd['now'] = New Carbon();


            $pdf = PDF::loadView('horaire.vacances.resultABS', $dd);

            return $pdf->download('absence_' . $dd['now']->copy()->format('Y_m_d') . '.pdf');


        }

    }

    public function storeAbs()
    {
    }

    public function validateAbs()
    {

        return view('horaire.vacances.test')->with('mconf', $this->mconf)->with('user', $this->user);
    }

    public function getCumuleEdit(Request $request, $id)
    {

        $cumule = Cumule::find($id);

        if ($cumule <> null)
        {

            $user = User::find($cumule->CUMULE_user);

            return view('horaire.cumulEdit')
                ->with('mconf', $this->mconf)
                ->with('user', $user)
                ->with('hg', new HoraireGestion($this->user))
                ->with('cumule', $cumule);
        } else
        {
            return redirect()->action('HoraireAdmController@QuePassa');
        }


    }

    public function postCumuleEdit(Request $request)
    {


        if ($request->get('rec') !== '00:00')
        {
            
            $negative = substr($request->get('rec'),0,1) === '-' ?  TRUE : FALSE;

            if($negative == true)
            {
                $h = substr($request->get('rec'), 1, 2) * 60;
                $m = intval(substr($request->get('rec'), strpos($request->get('rec'), ':') + 1, 3));
                $rec = -($h + $m);
                

            }
            else{
                $h = substr($request->get('rec'), 0, 2) * 60;
                $m = intval(substr($request->get('rec'), strpos($request->get('rec'), ':') + 1, 2));
                $rec = $h + $m;
                

            }
                
                

            
        } else
        {
            $rec = 0;
        }

        if ($request->get('hp') !== '00:00')
        {

            $h = substr($request->get('hp'), 0, 2) * 60;
            $m = intval(substr($request->get('hp'), strpos($request->get('hp'), ':') + 1, 2));
            $hp = $h + $m;
        } else
        {
            $hp = 0;
        }

        if ($request->get('hnp') !== '00:00')
        {

            $h = substr($request->get('hnp'), 0, 2) * 60;
            $m = intval(substr($request->get('hnp'), strpos($request->get('hnp'), ':') + 1, 2));
            $hnp = $h + $m;
        } else
        {
            $hnp = 0;
        }


        $data = [
            'CUMULE_cp_solde'  => $request->get('cp'),
            'CUMULE_rec_solde' => $rec,
            'CUMULE_hp_solde'  => $hp,
            'CUMULE_hnp_solde' => $hnp,
            'id'               => $request->get('id'),
        ];
        Cumule::where('id', $data['id'])->update($data);

        return redirect()->action('HoraireAdmController@QuePassa');

    }

}
