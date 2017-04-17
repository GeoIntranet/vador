<?php

namespace App\Http\Controllers;

use App\ExcludeInteger;
use App\Http\Controllers\Lib\Calender\CalenderGestion;
use App\Http\Controllers\Lib\Categorie\CategorieGestion;
use App\Http\Controllers\Lib\Stat\ClassifyGestion;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Lib\Gestion;
use Illuminate\Http\Request;
use App\IntegerCommand;
use App\LigneCommande;
use App\Commande;
use Carbon\Carbon;
use App\Client;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CommandSentClassifyController extends Gestion
{
    protected $calender;
    protected $commande;
    protected $client;
    protected $integer;
    protected $classify;
    protected $now;
    protected $excludeInteger;
    /**
     * CommandSentClassifyController constructor.
     */
    public function __construct(
        Commande $commande ,
        Client $client ,
        IntegerCommand $integer ,
        ClassifyGestion $classify,
        ExcludeInteger $excludeInteger
    )
    {

        $this->commande = $commande;
        $this->client = $client;
        $this->integer = $integer;
        $this->classify = $classify;
        $this->excludeInteger = $excludeInteger;
        $this->now= Carbon::now();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,CalenderController $calenderController, CalenderGestion $calender_)
    {
        // recup array users
        $user = $this->getUsers();

        // recherche dt session
        $dateSent = new Carbon($calenderController->getDt('CommandSentClassifyController'));

        // generation du calendrier en fonctione dt recup - $dateSent
        $calender = $calender_->generate($dateSent);

        //recherche date intervalle en fonction de datesent sur 1 jour
        $dateSentToDb = $this->dateIntervale($dateSent,1);

        //recherche des envoie en fonctione de date Begin / End
        $commandSent = $this->commande->CommandSent($dateSentToDb)->toArray();

        //on sort la colonne des client livré dans un array
        $client = array_column($commandSent, 'id_clientlivr');

        // on recherche le NSOC en fonction du tableau des client livré
        $clientName  = $this->client->NameClient($client);

        // on sort les commande et on en fait une collection
        $commandeBl = collect( array_column($commandSent, 'id_cmd') ) ;

        //recherche si liste bl integrer , et on ressort un tableau de BL
        $listBlIntegrate = $this->integer->CheckIntegrate($commandeBl,$dateSentToDb['begin'])->pluck('bl')->flip()->toArray();

        //cherche si bl integrer a la BONNE date ( en theori un meme BL ne peut pas etre integrer a deux date diff )
        $checkdt = $this->integer->CheckDate($dateSentToDb);

        // compte le nombre de bl
        $counterCommand =$commandeBl->count();

        //calcule du prix par cmd
        $listePrice = collect(LigneCommande::CommandPrice($commandeBl));

        // extraction du meilleur prix => MEILLEUR vente
        $maxPrice = $listePrice->max();

        //extraction du bl correspondant.
        $blMaxPrice = array_search($maxPrice,$listePrice->toArray());


         return view('stat.sent.sent_index')
             ->with('request',$request)
             ->with('calender_',$calender)
             ->with('user',$user)
             ->with('dateSent',$dateSent)
             ->with('commandes',$commandSent)
             ->with('clients',$clientName)
             ->with('integrate',$listBlIntegrate)
             ->with('countCommand',$counterCommand)
             ->with('blMAx',$blMaxPrice)
             ->with('priceMax',$maxPrice)
             ;
    }


    public function show(Request $request,$id,$ligneId)
    {
        $users= $this->getUsers();
        $clients=[];
        $ligne__=[];
        $arayLignePrestation=[];
        $categorie=[];

        $commande_bl = $this->commande->where('id_cmd',$id)->first();
        $date_sent = $commande_bl->date_livr->format('Y-m-d');

        $commandes = $this->commande
            ->select('id_cmd','id_clientlivr')
            ->where('date_livr',$date_sent)
            ->where('etat_livr',2)
            ->distinct('id_cmd')
            ->pluck('id_clientlivr','id_cmd');

        $clients = $commandes->flip()->keys();
        $clientName  = $this->client->NameClient($clients);
        $lignes = $this->integer->where('bl',$id)->get();
        $ligneSelected = $this->integer->find($ligneId);

        foreach ($lignes as $index => $ligne)
        {
            $categorie[$ligne->id] = $this->classify->findCategorie($ligne);
            $arayLignePrestation[$ligne->id]=$ligne->prestation;
            $ligne__[$ligne->id] = $ligne->id;
            $clients[] = $ligne->client_livr;
            $clients[] = $ligne->client_fact;
        }

        $prestation = $this->getPrestation();
        $catGlobal = $this->getCategorieGlobal();


        return view ('stat.sent.show')
            ->with('bl',$id)
            ->with('l',$ligneId)
            ->with('ls',$ligneSelected)
            ->with('ll',$arayLignePrestation)
            ->with('presta',$prestation)
            ->with('bls',$commandes)
            ->with('clients',$clientName)
            ->with('lignes',$lignes)
            ->with('cat',$categorie)
            ->with('catGlobal',$catGlobal)
            ->with('ligne__',$ligne__)
            ->with('dateSent',new Carbon($date_sent))
            ;
    }

    public function edit( $id , $arg , $value )
    {
        $errorArgument = ($arg == 'categorie' OR $arg == 'prestation') ? false : true ;

        if( $errorArgument == FALSE)
        {
            $argVal = $this->searchAndEditArg($id, $arg , $value);
        }

        return redirect()->back();
    }

    public function searchAndEditArg($id, $arg , $value)
    {
        if($arg == 'prestation')
        {
            $this->updatePrestation($id ,$value);
        }

        if($arg == 'categorie')
        {
            $this->updateCategorie($id ,$value);
        }

    }

    public function updatePrestation($id , $value)
    {
        if(is_int($value) and $value > 0 AND $value <10 )
        {
            $ligneCommande = $this->integer->find($id);
            $ligneCommande->prestation = intval($value);
            $ligneCommande->save();
        }
    }

    public function updateCategorie($id , $value)
    {
        if(isset($this->getCategorieGlobal()[$value]))
        {
            $ligneCommande = $this->integer->find($id);
            $ligneCommande->$value = $ligneCommande->$value == 1 ? 0 : 1;
            $ligneCommande->save() ;
        }
        else
        {
            var_dump('erreur categorie');
        }
    }
    /**
     * @param $bl
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyBl($bl)
    {
        IntegerCommand::where('bl',$bl)->delete();
        return redirect()->back();
    }

    /**
     * NON UTILISER ?
     * @param CategorieGestion $categorie
     * @param $date
     * @param $nbj
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LogicExecution(CategorieGestion $categorie,$date,$nbj)
    {
        $dateIntervalle = $this->dateIntervale($date,$nbj);
        $this->integerLogic($categorie, $dateIntervalle);
        return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     *
     * @param CategorieGestion $categorie
     * @param $bl
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LogicExecutionOnBl(CategorieGestion $categorie,$bl)
    {
        //prevention on detruit les entre correspondant au bl
        $this->destroyBl($bl);
        $this->classify->setPrestation($this->getPrestation());

        /* 2 recup cache redis */
        $this->classify->setCategorie($categorie->categorieRedisAll());

        /* 3 recherche de la commandes expedié */
        $commandSent = $this->commande->CommandSentBl($bl)->toArray();
        $this->classify->setCommandSent($commandSent);

        /* 4 Recherche info supplémentaire concernant le code postale des clients */
        $this->classify->getInformationClient();

        /* 5 recherche des lignes commande liée au bl */
        $this->classify->setLigneCommande($this->classify->getBl());

        /* 6 Execution */
        $this->classify->calculate();



        /* insertion des données - si rien n'est inserer verfi categorie REDIS */
       $this->integer->insert($this->classify->getInteger());
       return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     * @param CategorieGestion $categorie
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LogicExecutionOnDay(CategorieGestion $categorie,$date)
    {
        $dateIntervalle = $this->dateIntervale($date,1);

        $this->destroyDay($date);

        $this->integerLogic($categorie, $dateIntervalle);

        return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     * @param CategorieGestion $categorie
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LogicExecutionOnWeek(CategorieGestion $categorie,$date)
    {
        $dateIntervalle = $this->dateWeek($date);

        $this->destroyWeek($date);

        $this->integerLogic($categorie, $dateIntervalle);

        return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     * @param CategorieGestion $categorie
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function LogicExecutionOnMonth(CategorieGestion $categorie,$date)
    {
        $dateIntervalle = $this->dateMonth($date);

        $this->destroyMonth($date);

        $this->integerLogic($categorie, $dateIntervalle);

        return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     * @param CategorieGestion $categorie
     * @param $date
     */
    public function LogicExecutionOnYear(CategorieGestion $categorie,$date)
    {
        set_time_limit ( 0 );
        ini_set('memory_limit', '-1');
        
        $dateIntervalle = $this->dateYear($date);

        $this->destroyYear($date);

        $this->integerLogic($categorie, $dateIntervalle);

        return redirect()->action('CommandSentClassifyController@index');
    }

    /**
     * @param CategorieGestion $categorie
     * @param $dateIntervalle
     */
    public function integerLogic(CategorieGestion $categorie, $dateIntervalle)
    {
        /* 1 recup prestation */
        $this->classify->setPrestation($this->getPrestation());

        /* 2 recup cache redis */
        $this->classify->setCategorie($categorie->categorieRedisAll());

        /* 3 recherche commandes expedié */
        $commandSent = $this->commande->CommandSent($dateIntervalle)->toArray();
        $this->classify->setCommandSent($commandSent);

        /* 4 Recherche info supplémentaire concernant le code postale des clients */
        $this->classify->getInformationClient();

        /* 5 recherche des lignes commande liée au bl */
        $this->classify->setLigneCommande($this->classify->getBl());

        /* 6 Logique de calcule - categorisation - des différent lignes sur la commande */
        $this->classify->calculate();

        // eviter le flux trop important d'insert
        $size = 100;
        $chunks = array_chunk($this->classify->getInteger(), $size);
        foreach($chunks as $data) {
            $this->integer->insert($data);
        }
        $this->excludeInteger->insert($this->classify->getExlcude());
    }

    /**
     * @param $date
     */
    public function destroyDay($date)
    {
        $dt = $this->dateDay($date);
        IntegerCommand::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
        ExcludeInteger::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
    }

    /**
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyWeek($date)
    {
        $dt = $this->dateWeek($date);
        IntegerCommand::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
        ExcludeInteger::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
    }

    /**
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyMonth($date)
    {
        $dt = $this->dateMonth($date);
        IntegerCommand::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
        ExcludeInteger::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
    }

    /**
     * delete integration de l'année en cours.
     * @param $date
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyYear($date)
    {
        $dt = $this->dateYear($date);

        IntegerCommand::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
        ExcludeInteger::whereBetween('date_livr',[$dt['begin'],$dt['end']])->delete();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll()
    {
        IntegerCommand::whereNotNull('id')->delete();
        ExcludeInteger::whereNotNull('id')->delete();
    }

    /**
     * @param $order
     * @param $dt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disptachDestroy($order , $dt)
    {

        switch ($order) {
            case 'day':
                $this->destroyDay($dt);
                break;
            case 'week':
                $this->destroyWeek($dt);
                break;
            case 'month':
                $this->destroyMonth($dt);
                break;
            case 'all':
                $this->destroyAll();
                break;
        }
        return redirect()->back();

    }
}
