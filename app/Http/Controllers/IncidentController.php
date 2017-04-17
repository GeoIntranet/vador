<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Lib\Incident\IncidentGestion;
use App\Http\Controllers\Lib\Gestion;
use App\Commandes as Commandes;
use App\Incident as Incident;
use App\IncidentPost as Post;
use Illuminate\Http\Request;
use App\User as User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Redirect;
use Auth;
use DB;

class IncidentController extends Gestion
{

    //AIDE -------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------
    // SESSION ---------------------------------------------------------------------------------------------------------
    // Clef session //
    //  - incidentViewer -
    // -----------------------------------------------------------------------------------------------------------------


    public $incident;
    public $INCIDENT;
    public $Menu;
    /**
     * @var Incident
     */
    private $model;

    public function __Construct(Incident $model ,IncidentGestion $incident)
    {
        $this->incidentManager = $incident ;
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $incidents = '';

        $table = collect($this->incidentManager->handleAllUser());
        $table_ = $table['data'];

        $Lastincidents = $this->incidentManager->handleUser('preference');

        if( isset($Lastincidents->redisIncidentPreference) )
            $incidents = $Lastincidents->incidents
            ;


        $etat = $this->incidentManager->etat;
        $warning = $table['warning'];

        return view('incident.incidentEncours')
            ->with('table', $table_)
            ->with('incidents', $incidents)
            ->with('etat', $etat)
            ->with('warning', $warning)
            ->with('user', $this->getUsers());

    }

    public function incidentUser()
    {
        $table = collect($this->incidentManager->handleAllUser());
        $manager = $this->incidentManager->handleUser('session');

        $incidents = $manager->incidents;

        $warning = $table['warning'];

        return view('incident.incidentUser')
            ->with('manager',$manager)
            ->with('table',$table)
            ->with('incidents',$incidents)
            ->with('warning',$warning)
            ->with('users',$this->getUsers())
            ;

    }


    /**retourne l'utilisateur sur lequelle on veut voir les incident.
     * @param $u
     * @return mixed
     */
    public function MakeViewer($u , Request $request){

        session()->put('incidentViewer', $u);
        Redis::ZINCRBY('incident_pref_user'.Auth::user()->id,1,$u);


     return  redirect::action('IncidentController@incidentUser');

    }

    /*
    *retourne l'utilisateur sur lequelle on veut voir les incident.
     *
     * @return mixed
     */
    public function RemoveViewer(){
        session()->forget('incidentViewer');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        var_dump('creat incident');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function show(Request $request ,$id) {

        $manager = $this->incidentManager->handleUser('session');
        $incidents = $manager->incidents;

        $name = 'pref_incident_'.Auth::user()->id;
        $name2 = 'h_incident_'.Auth::user()->id;

        Redis::ZINCRBY($name,1,$id);
        Redis::HSET($name2,time(),$id);

        $range = Redis::ZREVRANGE($name,0,-1);

        try
        {
            $incident = Incident::findOrFail($id);

            $this->incidentManager->forYou($incident);

            $incidentExplication =
                str_replace('/imgs/trombinoscope/32x32',url("imgs/trombinoscope/32x32/"),$incident->explic);

            $incident->explic = $incidentExplication;

            $incident = collect($incident);

            $incident->explic = $incidentExplication;

            $listeIncidentUser = Incident::where('id_tech',48)->get();

            $request->session()->reflash();

            return view('incident.incidentView')
                ->with('incident',$incident->toArray())
                ->with('incidents',$incidents)
                ;

        }
        catch (ModelNotFoundException $ex)
        {
            return view('errors.503')
                ;
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incident = $this->model->find($id);

        $manager = $this->incidentManager->handleUser('session');
        $incidents = $manager->incidents;

        return view('incident.edit')
            ->with('incident', $incident)
            ->with('id', $id)
            ->with('incidents', $incidents)
            ->with('actions', $this->incidentManager->action)
            ->with('users', $this->incidentManager->getReceiver())
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->incidentManager->update($id, $request->input());
        return redirect()->action('IncidentController@show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function migrate(){

        //var_dump('MIGRATE');

        $UsersLists =User::listUsers();
        $Users_=[];

        foreach ($UsersLists as $k => $v) {
            $user_[$v->USER_nom]=$v->USER_id;
        }
        $this->users=$user_;

        $dtCarbon = Carbon::now();
        //10 9 // 8 7 6 5
        $dtCarbon->subYears(9);
        $offset = 1;
        $arg= 'A';
        $users_=[];





        //RECUP DES INCIDENTS
        $input1=Incident::IntSpecific($dtCarbon,$offset,$arg);
        //RECUP NB INCIDENT
        $counter=Incident::counter($dtCarbon);
        //var_dump($counter);
//
//        $spec = Incident::Find(27250);
//        //var_dump($spec->id);
//        //var_dump($spec->INCIDENTS_explic);
//        $this->FormateIncident($spec->id,$spec->INCIDENTS_explic);
//        var_dump($this->INCIDENT[27250]);

        //var_dump($this->users);
        $spec = Incident::Find(4274);
        //var_dump($spec->id);
        //var_dump($spec->INCIDENTS_explic);
        $this->FormateIncident($spec->id,$spec->INCIDENTS_explic);
        //var_dump($this->INCIDENT[4274]['post']);



        $INCIDENT=[];
        foreach ($input1 as $k => $v) {
            set_time_limit (1);
            var_dump($v->id);
            if(Post::PostIncidentExist($v->id)->isEmpty() == TRUE){

                $this->FormateIncident($v->id,$v->INCIDENTS_explic);
                //AUCUN POST LIEE A L INCIDENT CORRESPONDANT
                //CREATE
                $posts = $this->INCIDENT[$v->id]['post'];
                //var_dump($posts);

                foreach ($posts as $kposts => $vposts) {
                    $post= New Post();
                    $post->incident_id = $v->id;
                    $post->user_id =$vposts['userSource'];
                    $post->POST_target = $vposts['userTarget'];
                    $post->POST_content = $vposts['content'];
                    $post->POST_action = $vposts['action'];
                    $post->POST_datetime = $vposts['dateTime'];
                    $post->save();
                }


            }
            else{
                //var_dump("DEJA INTEGRER");
                ////POSTS EXISTANT POUR LINCIDENT
                //$this->FormateIncident($v->id,$v->INCIDENTS_explic);
                //$ctPostCalcultate = count($this->INCIDENT[$v->id]['post']);
                //$ctPostTable= Post::counterPostIncident($v->id)->count();

                //if($ctPostCalcultate != $ctPostTable){
                //    //NB POST DIFFERENT DONC IL Y A CONFLIT

                //    //Post::where('incident_id',$v->id)->delete();
                //    //var_dump( $this->FormateIncident($v));
                //}

            }

        }
//        //return Redirect()->action('IncidentController@index');




    }

    public function FormateIncident($id,$contenu){
        //print_r($contenu);

        $X= TRUE;
        $UserSource=0;
        $UserTarget=0;
        $Content=0;
        $inin=0;
        $diff=[];
        $Output=[];

        $attr = $this->IG->GetAttribut();
        $InputInc=[ 'Créa', 'Mise', ];
        $input = $contenu;


        if( $input != null ){
            $input = strip_tags($input, '<hr></hr>');
            $Explode1 = rtrim($input, "\n");
            $Explode = explode( "<hr>" , $Explode1 );


            foreach ($Explode as $k => $v) {
                if($k ==0){
                    $Output[]=TRUE;
                }
                else{
                    $ATT1 = substr($InputInc[0],0,4);
                    $ATT2 = substr($InputInc[1],0,4);
                    $STR = ltrim($v);
                    $STR2 =substr($STR,0,4);


                    if($ATT1 == $STR OR $ATT2 == $STR2){$X= TRUE;}else{$X= FALSE;}
                    $Output[]=$X;
                }
            }

            foreach ($Output as $k => $v) {
                if($v == TRUE){
                    $inin = $k;
                }
                if($v == FALSE){
                    $diff[$k]=$inin;
                }
            }

            foreach ($diff as $k => $v) {
                $Explode[$v] = $Explode[$v].' '.$Explode[$k];
                unset($Explode[$k]);
            }

            //REORGANISATION DES INDEX DES POST DANS L INCIDENT
            $i=0;
            foreach ($Explode as $k => $v) {
                if($i != 0){
                    $Explode[$i]=$v;
                    unset($Explode[$k]);
                }
                $Explode[$i]=$v;
                $i++;
            }

            foreach ($Explode as $k => $v) {

                $Date = $this->IG->FindDate($v);
                $Time = $this->IG->FindTime($v);
                $DateTime = $Date.' '.$Time;

                $UserSource = $this->IG->FindUserSource($v);
                $UserTarget = $this->IG->FindUserTarget($v);


                if($UserSource != FALSE){
                    if(!isset($this->users[$UserSource])){
                        $UserSource=666;
                    }
                    else{
                        $UserSource = $this->users[$UserSource];
                    }
                }
                if($UserTarget != FALSE){
                    if(!isset($this->users[$UserTarget])){
                        $UserTarget=666;
                    }
                    else{
                        $UserTarget = $this->users[$UserTarget];
                    }
                }

                $BracketSearch =  substr($v, strpos($v, "(")+1,1);

                if(!is_numeric($BracketSearch)){
                    $CTTT =  substr($v, strpos($v, "]"));
                }
                else{
                    $CTTT =  substr($v, strpos($v, ")"));
                }

                $this->INCIDENT[$id]['post'][]=[
                    'userSource' =>$UserSource,
                    'userTarget' =>$UserTarget,
                    'dt' =>$Date,
                    'time' =>$Time,
                    'dateTime' =>$DateTime,
                ];

                $vattr=99999;
                $CT='';

                foreach ($attr as $kattr => $vattr) {
                    $pos = stripos($CTTT,$kattr,0);
                    if($pos == TRUE ){
                        $CT= substr($CTTT,1,$pos-1);
                        $this->INCIDENT[$id]['post'][$k]['content']=$CT;
                        $this->INCIDENT[$id]['post'][$k]['action']=$vattr;
                    }
                }
                if(!isset( $this->INCIDENT[$id]['post'][$k]['content'])){   $this->INCIDENT[$id]['post'][$k]['content']=$CT;}
                if(!isset( $this->INCIDENT[$id]['post'][$k]['action'])){   $this->INCIDENT[$id]['post'][$k]['action']=$vattr;}
            }

        }



    }

    public function aLaRechercheDuNom(){

        $UsersLists =User::listUsers();
        $Users_=[];

        foreach ($UsersLists as $k => $v) {
            $user_[$v->USER_nom]=$v->USER_id;
        }

        $this->users=$user_;
        $word = " Création d'incident le 15/02/2016 à 09:29:12 par Diane MINGAZ [30]pb de resolution ecran avec aplidis + quadraAppel/Dossier passé à... --> Christophe CREZE [*7930]";



        $word =ltrim($word);
        $word =rtrim($word);
        $TestId= substr($word,-3,-1);


        if(is_numeric($TestId) == TRUE){
            //INCIDENT RECENT
            $posFin = strrpos($word, ' ');
            $chaine = substr($word,0,$posFin);
            $lengh = strlen($chaine);
            $search = -1*($lengh-$posFin)-1;
            $posFinesp = strrpos($chaine,' ',$search)+1;
            $finPos = $posFin-$posFinesp;
            $NOMT = substr($chaine,$posFinesp,$finPos);
        }
        else{
            //VIELLE INCIDENT
            $posFin = strrpos($word, ' ');
            $lengh = strlen($word);
            $chaine = substr($word,$posFin,$lengh);
        }





        $spec = Incident::Find(31597);
        $this->FormateIncident($spec->id,$spec->INCIDENTS_explic);
        var_dump($this->INCIDENT[31597]['post']);



    }

    public function testingOrmIncident(){

        /**
         * Test des différents type de liaisons  ! ORM ELOQUENT
         */
        //$IncidentsPost= Incident::Find(4083)->posts;
        //$IncidentsAuteur= Incident::Find(4083)->auteurs;
        //$postUser = User::find(1)->posts->where('incident_id',4305);


    }
}