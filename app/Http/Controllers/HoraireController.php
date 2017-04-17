<?php
namespace App\Http\Controllers;

use Barryvdh\Debugbar\LaravelDebugbar as debugbar_;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Redirect;
use Auth;
use Input;
use DB;
use App\Cumule;
use App\Horaire;
use App\Http\Controllers\Lib\HoraireGestion as HoraireGestion;
use App\Http\Controllers\Lib\CumuleGestion;
use App\Http\Controllers\Lib\MenuGestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Lib\Gestion;

class HoraireController extends Controller
{
    public $Menu;
    public $user;
    public $today;
    public $gestion;
    public $cumule;
    public $mconf;

    /**
     * HoraireController constructor.
     */
    function __construct()
    {
        $user = Auth::user()->id;

        $this->user = $user;
        $this->hg = new HoraireGestion($user);
    }

    /**
     * DEPENDENCE HG / H
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Horaire $h)
    {
        $this->h = $h;

        if (!$this->Check()) {

            $prestations = $this->hg->getPrestations();
            $nextDtToEdit = $this->hg->searchDateAvailable();

            if ($nextDtToEdit == Carbon::now()->format('Y-m-d')) {

                return Redirect::action('HoraireController@index');

            } else {

                $dtToEdit = new Carbon($nextDtToEdit);
                $planning = $this->hg->getPlanning();
                $numberOfDay = $dtToEdit->dayOfWeek;
                $timeToTaff = $planning[$numberOfDay];
                $decomposeNext = $this->hg->decompose($dtToEdit);

                return view('horaire.horaire')
                    ->with('presta', collect($prestations))
                    ->with('next', $dtToEdit)
                    ->with('dNext', $decomposeNext)
                    ->with('htaff', $timeToTaff);

            }
        } else {

            $Lundi = 1;
            $total = 5;

            $horaire = collect($this->h->getHorraire($this->user));

            $solde = Cumule::where('CUMULE_user', $this->user)
                ->orderBy('CUMULE_dt', 'DESC')
                ->first();

            $dt = new Carbon($horaire->first()->date_r);
            $dtStar__ = $dt->copy();
            $dtEnd__ = $dt->copy()->addWeeks(5)->endOfWeek()->subWeek(1)->addDay(1);
            $diffInWeeks = $dtStar__->copy()->endOfWeek()->subWeek(1)->diffInWeeks($dtEnd__->copy()->endOfWeek()->addDay(1));
            $decalageDay = $dt->dayOfWeek;
            $miseNiveau = $decalageDay - $Lundi + 1;

            $i = 1;

            while ($i < $miseNiveau) {
                $dt_ = $dt->subDay(1);
                $horaire->prepend($dt_->format('Y-m-d'));
                $i++;
            }

            $formatHoraire = $horaire->chunk(5);
            //var_dump($formatHoraire);
            $keyformatHoraire = $formatHoraire->keys();
            $keyMax = $keyformatHoraire->max();
            $decalageFin = count($formatHoraire[$keyMax]) - 1;
            $lastDtR = $formatHoraire[$decalageFin]->last()->date_r;
            $lastDtR = new Carbon($lastDtR);
            $reguleDecalage = $total - $decalageFin;
            $i = 1;

            while ($i < $reguleDecalage + 1) {
                $dt_ = $lastDtR->addDay(1);
                $horaire->push($dt_->format('Y-m-d'));
                $i++;
            }

            $formatHoraire = $horaire->chunk(5);
            $ftt = [];

            foreach ($formatHoraire as $kft_ => $ft_) {

                $ftt[$kft_] = [];

                foreach ($ft_ as $kf => $vf) {

                    $r = (isset($vf->recup)) ? TRUE : FALSE;
                    $dt = (isset($vf->date_r)) ? $vf->date_r : $vf;
                    $h = (isset($vf->heures_taff)) ? $vf->heures_taff : FALSE;
                    $id = (isset ($vf->id)) ? $vf->id : FALSE;
                    $cp = (isset($vf->cp)) ? $vf->cp : FALSE;
                    $cp2 = (isset($vf->cp2)) ? $vf->cp2 : FALSE;
                    $hp = (isset($vf->heure_paye)) ? $vf->heure_paye : FALSE;
                    $rec = (isset($vf->recup)) ? $vf->recup : FALSE;
                    $ef = (isset($vf->ef)) ? $vf->ef : FALSE;
                    $hnp = (isset($vf->hnp)) ? $vf->hnp : FALSE;
                    $com = (isset($vf->com)) ? $vf->com : FALSE;
                    $N = (($cp OR $cp2 OR $hp OR $rec OR $ef OR $hnp) <> 1) ? TRUE : FALSE;
                    
                    $ftt[$kft_][$kf] = [
                        'id' => $id,
                        'interval' => $r,
                        'normalState' => $N,
                        'dt' => $dt,
                        'h' => $h,
                        'rec' => $rec,
                        'hp' => $hp,
                        'hnp' => $hnp,
                        'cp' => $cp,
                        'cp2' => $cp2,
                        'ef' => $ef,
                        'com' => $com,
                    ];
                }
            }
            return view('horaire.viewHoraire')
                ->with('h', $ftt)
                ->with('dts', $dtStar__)
                ->with('dte', $dtEnd__)
                ->with('g', new Gestion())
                ->with('hg', new HoraireGestion($this->user))
                ->with('solde', $solde)
                ->with('diffW', $diffInWeeks)
                ->with('mconf', $this->mconf);
        }
    }

    /**
     * DEPENDENCE HG
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        var_dump('JE CREE');
    }

    /**
     * DEPENDENCE HG
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->Check()) {
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
            $baseTravail = input::get('ht');
            $minuteBase = $this->hg->hm($baseTravail);
            $validation = FALSE;
            $validation = $this->Validation($request, $input);
            if ($validation == FALSE) {
                return redirect()->action('HoraireController@index')->withInput();
            } else {
                $this->hg->record();
                $request->session()->flash('SucessHorraire', 'Votre horraire a bien été prit en compte ! ');
                return redirect()->action('HoraireController@index');
            }
        } else {
            return Redirect::route('Dashboard');
        }
    }

    /**
     * DEPENDENCE NONE
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        var_dump($id);
    }

    /**
     * DEPENDENCE HG / user
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit($id, Request $request)
    {
        $horaire = Horaire::find($id);
        if (!is_null($horaire)) {
            if ($horaire->user == $this->user) {
                if ($horaire->com <> 'FERRIER') {
                    $dtToEdit = new Carbon($horaire->date_r);
                    $planning = $this->hg->getPlanning();
                    $numberOfDay = $dtToEdit->dayOfWeek;
                    $timeToTaff = $planning[$numberOfDay];
                    $decomposeNext = $this->hg->decompose($dtToEdit);
                    $prestations = $this->hg->getPrestations();
                    return view('horaire.editHoraire')
                        ->with('h', $horaire)
                        ->with('next', $dtToEdit)
                        ->with('dNext', $decomposeNext)
                        ->with('htaff', $timeToTaff)
                        ->with('presta', collect($prestations))
                        ->with('mconf', $this->mconf);
                } else {
                    $request->session()->flash('errorUser', 'C\'est un jour fèrié , tu ne peut pas modifier cette date.');
                    return redirect::route("horaire.index");
                }
            } else {
                $request->session()->flash('errorUser', 'Tu essaye de modifier les horaires d\'un autre utilisateur ... ! ');
                return redirect::route("horaire.index");
            }
        } else {
            $request->session()->flash('noExist', 'Cette horaire n\'existe pas ! ');
            return redirect::route("horaire.index");
        }
    }

    /**
     *
     * DEPENDENCE HG / C /  CG / user
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Cumule $c, CumuleGestion $cg)
    {
        $this->c = $c;
        $this->cg = $cg;
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
        $baseTravail = input::get('ht');
        $minuteBase = $this->hg->hm($baseTravail);
        $validation = FALSE;
        $validation = $this->Validation($request, $input);
        if ($validation == FALSE) {
            return redirect()->action('HoraireController@edit', ['id' => $id])->withInput();
        } else {
            $data = $this->hg->getData();
            $hp = (isset($data['heures_paye'])) ? $data['heures_paye'] : $data['heure_paye'];
            $dt = $this->cg->GetDtCumule($data['date_r']);
            DB::table('horraires')
                ->where('id', $id)
                ->update([
                    'heures_taff' => $data['heures_taff'],
                    'com' => $data['com'],
                    'recup' => $data['recup'],
                    'heure_paye' => $hp,
                    'cp' => $data['cp'],
                    'cp2' => $data['cp2'],
                    'ef' => $data['ef'],
                    'hnp' => $data['hnp'],
                ]);
            DB::table('Cumules')
                ->where('CUMULE_dt', '>', $dt)
                ->where('CUMULE_user', $this->user)
                ->delete();
            $this->c->Cumule($this->user, 1);
            $request->session()->flash('SucessHorraire', 'Votre horraire a bien été prit en compte ! ');
            return redirect()->action('HoraireController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * DEP HG
     * Check si l'utilisateur est a jour ou pas.
     * @return bool
     */
    public function Check()
    {
        $ldtr = new carbon($this->hg->ldtr()->date_r);
        $ldtr_1 = ($ldtr->dayOfWeek == 5) ? $ldtr->copy()->addDays(3)->format('Y-m-d') : $ldtr->copy()->addDay(1)->format('Y-m-d');
        return ($ldtr_1 >= Carbon::now()->format('Y-m-d')) ? TRUE : FALSE;
    }

    /**
     * DEP HG
     * @param Request $request
     * @param $input
     * @return bool
     */
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
        $validation = TRUE;
        if ($minuteUser > 1440) {
            $validation = FALSE;
            $request->session()->flash('ClassWarningM', 'warning');
            $request->session()->flash('hToHigh', 'Vous ne pouvez pas travaillé plus de 24h par jour');
            $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
        }
        if ($minuteUser > $minuteBase) {
            if ($presta == 'cp' OR $presta == 'cp2' OR $presta == 'ef' OR $presta == 'hpn' OR $presta == 'n') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('errorPresta', 'Vous n\'avez pas choisit la bonne préstation.');
            }
            if ($presta == 'rec' OR $presta == 'hp') {
                if ($com == '') {
                    $validation = FALSE;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('noMsg', 'Commentaire requis pour la validation du formulaire.');
                } else {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);
                }
            }
            if ($presta == '') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('noPresta', 'Vous avez fait plus d\'heures que prévu, choissisez une préstation.');
                if ($com == '') {
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                }
            }
        }
        if ($minuteUser == $minuteBase) {
            if ($presta <> '' AND $presta <> 'n') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('tooPresta', 'Aucune préstation requise lorsque vous faites des horaires normales.');
            } else {
                $this->hg->setDatadt($dtr)->setPrestation($presta)->setDataH($heureUserFormat);
            }
        }
        if ($minuteUser < $minuteBase) {
            //var_dump('heure USER inferieur a heure de base');
            if ($presta == 'cp' OR $presta == 'ef') {
                $this->hg
                    ->setPrestation($presta)
                    ->setDatacom($com)
                    ->setDatadt($dtr);
            }
            if ($presta == 'cp2') {
                if ($minuteUser <> 240) {
                    $validation = FALSE;
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('errorHeure', 'Il faut que vous indiquiez 4h dans la case heures travaillé.');
                } else {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);
                }
            }
            if ($presta == 'hp') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('lowHeure', 'Vous n\'avez pas fait d\'heures supplémentaires');
            }
            if ($presta == 'n') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('lowHeure', 'Vous n\'avez pas fait d\'horaires normal');
            }
            if ($presta == 'rec') {
                if ($com == '') {
                    $validation = FALSE;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                    $request->session()->flash('noMsg', 'Commentaire requis pour la validation du formulaire.');
                } else {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);
                }
            }
            if ($presta == 'hpn') {
                if ($com == '') {
                    $validation = FALSE;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                } else {
                    $this->hg
                        ->setPrestation($presta)
                        ->setDatacom($com)
                        ->setDataH($heureUserFormat)
                        ->setDatadt($dtr);
                }
            }
            if ($presta == '') {
                $validation = FALSE;
                $request->session()->flash('NoHoraire', 'Votre saisie n\'a pas été comptabilisé');
                $request->session()->flash('noPresta', 'Vous avez fait moins d\'heures que prévu, choissisez une préstation.');
                if ($com == '') {
                    $validation = FALSE;
                    $request->session()->flash('ClassWarningC', 'warning');
                    $request->session()->flash('noMsg', 'Commentaire réquis pour la validation du formulaire.');
                }
            }
        }
        //$validation = ($validation == TRUE) ? 'validation OK ' : 'validation ECHOUER';
        if ($validation == TRUE) {
            $request->session()->flash('SucessHorraire', 'Votre horraire a bien été prit en compte ! ');
            return TRUE;
        } else {
            return FALSE;
            var_dump('LA VALIDATION A ECHOUER');
            return redirect()->action('HoraireController@index')
                ->withInput();
        }
    }

    public function showHoraire()
    {
    }

    /**
     * DEP HG
     */
    public function debug()
    {
        var_dump($this->Check());
        $nextDtToEdit = $this->hg->searchDateAvailable();
        var_dump($nextDtToEdit);
    }
}