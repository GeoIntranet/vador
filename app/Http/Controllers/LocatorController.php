<?php

namespace App\Http\Controllers;


use App\Article;
use App\Http\controllers\Lib\Locator\LocatorGeneratorInterface;
use App\Http\Controllers\Lib\Locator\repositoryLocatorManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Lib\Locator\LocatorManager;
use App\Http\Controllers\Lib\Locator\LocatorCache;
use App\Http\Controllers\Lib\Locator\Maker;
use App\Http\Controllers\Lib\Id\IdManager;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\FamilleArticle;
use App\Container;
use App\Stock;


class LocatorController extends EuroController
{
    protected $user;
    protected $locatorMaker;
    protected $manager;
    protected $cache;
    protected $container;


    /**
     * LocatorController constructor.
     */
    public function __construct(
        LocatorGeneratorInterface  $locator ,
        Container $container ,
        LocatorManager $manager,
        LocatorCache $cache
    )
    {
        $this->locatorMaker = $locator;
        $this->cache = $cache;
        $this->manager = $manager;
        $this->container = $container;

        $this->keySession = 'locator_search_'.Auth::user()->id;
        $this->keyRedis = 'locator_query_filtred_'.Auth::user()->id;
        $this->keyEmplacement = 'locator_preference_'.Auth::user()->id;

        $this->id = '';
    }


    /**
     * @return $this
     */
    public function index()
    {
        $nameQueryFiltred ='';

        if(session()->has($this->keySession))
        {
            $session = session()->get($this->keySession);

            if($session['emplacement'] <> '') Redis::ZINCRBY('locator:'.$this->keyEmplacement,1,$session['emplacement']);

            if($this->manager->isEmptySession($session)) return redirect()->action('locatorController@noSession');

            if(is_array($session['description'])) $session['description'] = implode(' ', $session['description']);

            $manager = $this->manager->prepareQuery($session)->execute();

            $counter = $this->manager->counter;
            $result = $manager->query;

            if ( ! $result->isEmpty() ) $nameQueryFiltred = json_decode($this->cache->cacheQueryFiltred($session))->read;

            return view('locator.show')
                ->with('id',$this->id)
                ->with('nameFilter',$nameQueryFiltred)
                ->with('session',$session)
                ->with('counter',$counter)
                ->with('articles',$result)
                ;
        }

        return view('locator.show')
            ->with('id',$this->id)
            ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function depot()
    {
        $maker = new Maker();

        $element = $maker->elementDefinition;
        $zone = $maker->zone;

        $table = $element->where('zone',2)->sortByDesc('order');
        $emp = new Stock();
        $id_emplacement = $emp->emplacement()->pluck('keyword');
        $exception = [];

        foreach ( $id_emplacement as  $index => $item) {
            if(
                ( substr($item,-1)=='4' )
                AND
                ( strlen($item) ==4 )
                AND
                ( substr($item,0,1) !== 'T' )
                AND
                ( substr($item,2,1) == '0' )
            )

                $exception[]= substr($item,0,2);
        }

        return view('locator.index')
            ->with('elements',$table)
            ->with('exception',collect($exception)->flip())
            ->with('zones',$zone)
            ;


    }

    /**
     * @return $this
     */
    public function noSession()
    {
        Session::forget($this->keySession);
        return view ('locator.show')
            ->with('id',$this->id)
            ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session()->reflash();
        session()->forget($this->keySession);
        Redis::ZINCRBY($this->keyEmplacement,1,$id);
        $articles = $this->manager->searchEmplacement($id)->get();

        return view('locator.show')
            ->with('articles', $articles)
            ->with('nameFilter', strtoupper($id))
            ->with('id', $id);

    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request , $id)
    {
        session()->reflash();
        try
        {
            session()->reflash();
            $articleLocator = Stock::findOrFail($id);
            $manager = app(IdManager::class)->init($articleLocator);

           return view('locator.edit')
               ->with('locator',$manager)
               ;
        }
        catch (ModelNotFoundException $ex)
        {
            return view('errors.503')
                ;
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function filtreStoreArticle(request $request)
    {
        session()->reflash();
        $model = $this->manager->searhEquivalentModel($request->art_search);
        $model_ = [];

        foreach ($model as $index => $data) {
            $model_[$data->art_model] = $data->art_model.'-'.$data->art_type.'-'.$data->art_marque.'-'.$data->short_desc;
        }

        $request->flash();
        $request->session()->flash('models',$model_);

        return redirect()->back()->withInput();
    }

    /**
     * @param Request $request
     * @param repositoryLocatorManager $manager
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, repositoryLocatorManager $manager )
    {
        session()->reflash();
        $manager
            ->init($request)
            ->update()
        ;
        if(session()->get('locatorMode') == 'multi'){
            return redirect()->action('locatorController@getMulti')->withInput();
        }
        return redirect()->action('locatorController@forceSearching',['id',$request->id]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outId(Request $request , $id)
    {
        try
        {
            $articleLocator = Stock::findOrFail($id);
            $manager = app(IdManager::class)->init($articleLocator);

            return view('locator.out')
                ->with('locator',$manager)
                ->with('articles',$manager->id)
                ;
        }
        catch (ModelNotFoundException $ex)
        {
            return view('errors.503')
                ;
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function applyOutId(Request $request)
    {
        $outManager = $this->manager->OutLocator()->setRequest($request);

        if($outManager->validformatOut())
        {
            //$outManager->getOut();
            return redirect()->action('locatorController@forceSearching',['id',$request->id]);
        }

        $outManager->flashMsg();
        return Redirect::back()->withInput();
    }

    /**
     * @param Request $request
     * @param $input
     * @return mixed
     */
    public function forceInput(Request $request ,$input)
    {
        session()->reflash();
        if( $this->cache->exist($this->keyRedis, false) )
        {
            $data = collect($this->cache->get($this->keyRedis, false)  );

            if($data->has($input))
            {
                $data = $data[$input]['input'];
                $session = $request->session();
                $data = collect($data)->toArray();

                $neuf = $data[1];
                $occase = $data[11] ;
                $reconstruire = $data[21] ;
                $hs = $data[22] ;
                $audite = $data[0] ;
                $out = $data['out'] ;

                $value = [
                    'id' =>$data['id'],
                    'emplacement' => $data['emplacement'],
                    'article' => $data['article'],
                    'description' => $data['description'],
                    '1' => $neuf,
                    '11' => $occase,
                    '21' => $reconstruire,
                    '22' => $hs,
                    '0' => $audite,
                    'out' => $out,

                ];
                $request->session()->put($this->keySession,$value);

                return redirect()->action('locatorController@index');
            }

        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        session()->reflash();
        $this->manager->prepareSessionSearch($request);
        return redirect()->action('locatorController@index');
    }

    /**
     * @param $arg
     * @param $value
     * @return mixed
     */
    public function forceSearching($arg,$value)
    {
        session()->reflash();
        $user = Auth::user()->id;
        $key ='locator_search_'.$user;

        $value_ = [
            'id' => '',
            'emplacement' => '',
            'article' => '',
            'description' => [],
            '1' => 0,
            '11' => 0,
            '21' => 0,
            '22' => 0,
            '0' => 0,
            'out' => 0,
        ];
        $value_[$arg] = $value;

        session()->forget($key);
        session()->put($key,$value_);

        return redirect()->action('locatorController@index');
    }

    /**
     * @return $this
     */
    public function lastOut()
    {
         $filtre = session()->has('filtre_out') ;
         $filtre_ = [] ;

         if($filtre)
         {
             $filtre_ = session()->get('filtre_out') ;
             $out = Stock::whereNotNull('out_datetime')
                 ->whereIn('id_locator',$filtre_)
                 ->orderBy('out_datetime','DESC')
                 ->with('articleModel')
                 ->paginate(20)
             ;

             return view('locator.showOut') ->with('articles',$out) ;
         }

        $out = $this->manager
            ->OutLocator()
            ->selectOut('paginate') ;

        return view('locator.showOut') ->with('articles',$out) ;

    }

    /**
     * @param Request $request
     */
    public function lastOutFiltre(Request $request)
    {
        $filtre =$request->input('filtre');

        $ids = Stock::whereNotNull('out_datetime')
            ->select('id_locator')
            ->join('articles2', 'locator.article', '=', 'articles2.art_model')
            ->where(function($query) use($filtre)
            {
                $query
                    ->where('art_model', 'LIKE', "%$filtre%")
                    ->orwhere('art_type', 'LIKE', "%$filtre%")
                    ->orwhere('art_marque', 'LIKE', "%$filtre%")
                    ->orwhere('short_desc', 'LIKE', "%$filtre%");
            })

            ->orderBy('out_datetime','DESC')
            ->limit(0)
            ->take(20)
            ->pluck('id_locator');

        session()->flash('filtre_out',$ids);

        return redirect()->back()->WithInput();

    }


    public function getLastIn()
    {
        $filtre = session()->has('filtre_in') ;
        $filtre_ = [] ;

        if($filtre)
        {
            $filtre_ = session()->get('filtre_in') ;
            $in = Stock::whereIn('id_locator',$filtre_)
                ->orderBy('in_datetime','DESC')
                ->with('articleModel')
                ->paginate(20)
            ;

            return view('locator.last.in')->with('articles',$in) ;
        }

        $in = $this->manager
            ->InLocator()
            ->selectIn('paginate') ;

        return view('locator.last.in')->with('articles',$in) ;
    }

    public function postLastIn(Request $request)
    {
        $filtre =$request->input('filtre');

        $ids = Stock::select('id_locator')
            ->join('articles2', 'locator.article', '=', 'articles2.art_model')
            ->where(function($query) use($filtre)
            {
                $query
                    ->where('art_model', 'LIKE', "%$filtre%")
                    ->orwhere('art_type', 'LIKE', "%$filtre%")
                    ->orwhere('art_marque', 'LIKE', "%$filtre%")
                    ->orwhere('short_desc', 'LIKE', "%$filtre%");
            })

            ->orderBy('in_datetime','DESC')
            ->limit(0)
            ->take(20)
            ->pluck('id_locator');

        session()->flash('filtre_in',$ids);

        return redirect()->back()->WithInput();
    }

    /**
     * @return $this
     */
    public function getMulti()
    {
        $data = [];
        $id = session()->has('dataMultiple') ? session()->get('dataMultiple') : [];

        if(session()->has('dataMultiple'))
        {
            $id = session()->get('dataMultiple');
            session()->flash('locatorMode','multi');
            session()->flash('dataMultiple',$id);

            $data = $this->manager ->multiID() ->searchID($id) ;
        }

        return view('locator.multi')
            ->with('articles',$data)
            ->with('ids',$id)
            ;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postMultiId(Request $request)
    {
        $ids = [];

        $multiManager = $this->manager
            ->multiID()
            ->setRequest($request);

        session()->flash('errorMulti', 'La recherche n\'as pas abouti');

        if (! $multiManager->validateInput() )
        {
            $ids = $multiManager
                ->searchArrayID()
                ->searchArrayID()
                ->flash();
        }

        return redirect()->action('locatorController@getMulti')->withInput();
    }

    /**
     * @return $this
     */
    public function getMultiOut()
    {
        session()->reflash();
        if(session()->has('dataMultiple')){
            $ids = Stock::with('articleModel')->whereIn('id_locator',session()->get('dataMultiple'))->get();
            return
                view('locator.out.multi')
                    ->with('articles',$ids)
                ;
        }

        return redirect()->action('locatorController@getMulti')->withInput();
    }

    /**
     * @param Request $request
     */
    public function postMultiOut(Request $request)
    {
        session()->reflash(['dataMultiple']);
        $outManager = $this->manager->OutLocator()->setRequest($request);

        if($outManager->validformatOut())
        {
            $outManager->multipleGetOut();
            session()->forget('error_cmd');
            session()->flash('success_out','les ID ont bien été modifier.');
            return redirect()->back()->withInput();
        }
        session()->flash('error_cmd','Mauvais format de commande saisi');
        return redirect()->back()->withInput();

    }

    /**
     * @return $this
     */
    public function getMultiDeplacement()
    {
        session()->reflash();

        if(session()->has('dataMultiple'))
        {
            $emplacements = (new Stock())->emplacement()->pluck('keyword');

            $ids = Stock::with('articleModel')->whereIn('id_locator',session()->get('dataMultiple'))->get();
            return
                view('locator.deplacement.multi')
                    ->with('emps',$emplacements)
                    ->with('articles',$ids)
                ;
        }

        return redirect()->action('locatorController@getMulti')->withInput();
    }
    /**
     * @return $this
     */
    public function postMultiDeplacement(Request $request)
    {
        session()->reflash(['dataMultiple']);
        $emplacements = collect((new Stock())->emplacement()->pluck('keyword'))->flip();
        $valide = $emplacements->has($request->get('emp'));

        if($valide)
        {
            Stock::whereIn('id_locator',session()->get('dataMultiple'))
                ->update([
                   'locator' => $request->get('emp')
                ])
            ;
            session()->forget('error_deplacement');
            session()->flash('success_deplacement','les ID ont bien été modifier.');
            return redirect()->back()->withInput();
        }
        session()->flash('error_deplacement','Mauvais format de l\'emplacement specifier');
        return redirect()->back()->withInput();

    }

    /**
     * 
     */
    public function getCatalogue()
    {
        $data = session()->has('catalogue_data') ? session()->get('catalogue_data') : [];
        $msg = 'Affichage des 25 derniers article crées';

        if(  empty($data) )
        {
            $data = Article::orderBy('id_article','DESC')
                ->with('idLocator','achats')
                ->limit(0)
                ->take(30)
                ->get()
            ;
        }
        else{
            $msg = 'Resultat de la recherche pour le mot <u>'.old('filtre').'</u>';
            $data = Article::whereIn('id_article',session()->get('catalogue_data'))
                ->orderBy('id_article','DESC')
                ->with('idLocator','achats')
                ->get()
            ;
        }

        //Affichage des dernier article crée
        return view('locator.catalogue.catalogue')
            ->with('articles',$data)
            ->with('msg',$msg)
            ;
    }


    /**
     *
     */
    public function postCatalogue(Request $request)
    {
        $filtre = $request->input('filtre');
        $id = [];
        if($filtre <> '')
        {
            $id = Article::select('id_article')
                ->where('art_model', 'LIKE', "%$filtre%")
                ->orwhere('art_type', 'LIKE', "%$filtre%")
                ->orwhere('art_marque', 'LIKE', "%$filtre%")
                ->orwhere('short_desc', 'LIKE', "%$filtre%")
                ->pluck('id_article')
            ;
            session()->flash('catalogue_data',$id);
            return redirect()->back()->withInput();
        }
        session()->flash('error_catalogue','Format saisie incorrect');
        return redirect()->back();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function relations()
    {


        //$user = User::find(32)->USER_prenom;
        //$client  = Client::find('030134');
        $object = Stock::find(142321);
        var_dump($object->article);



        //$commercial = $client->Commercial();
        //$order = $user->order();
        //$da = $user->achat();
        //$infoBl = $user->InfoCommande();
        //$infoTechnique = $user->InfoTechnique();
        //$famille  = Stock::where('locator','E203')->famille();
        //$creationIncident = $user->CreationIncident();
        //$participationIncident = $user->ParticipationIncident();
        //$in_articles=$user->sortie();
        //$clients=$user->client();
        //$ventes=$user->vente();
        //$details=$user->LigneCommandes();
        //$preparations=$user->preparation();

        //var_dump($commercial);
        //var_dump($order->pluck('po_id'));
        //var_dump( $da->pluck('id_pd') );
        //var_dump($infoBl->pluck('info_prod','id_cmd'));
        //var_dump($clients->get()->toArray());
        //var_dump($infoTechnique->pluck('explic','titre'));
        //var_dump($ventes->get()->toArray());
        //var_dump($preparations->get()->toArray());
        //var_dump($creationIncident->get()->toArray());
        //var_dump($participationIncident->get()->toArray());
        //var_dump($famille->get()->toArray());




    }

    public function hydrate()
    {
        return view('locator.hydrate');
    }

    public function fetcher(Request $request)
    {
        /*
         *  1. validation des donnée
         *  2. épurer les input , token etc...
         *  3. remplire les fillable du model
         *
         */

        /*
         * 1. Validation
         */

        $dataModel = $this->fetchModel($categorie, $request);

        var_dump($dataModel);

    }

    /**
     * Pour remplir la base avec des données
     */
    public function fakeDataLocator()
    {
//        INSERT INTO `containers` VALUES ('','J503', '15', '0', '1', '0', '1', '1', '2', null, null);
//        INSERT INTO `containers` VALUES ('','I503', '15', '0', '2', '0', '1', '0', '2', null, null);
//        INSERT INTO `containers` VALUES ('','H503', '15', '0', '3', '0', '1', '1', '2', null, null);
//        INSERT INTO `containers` VALUES ('','G503', '15', '0', '4', '0', '1', '0', '2', null, null);
//        INSERT INTO `containers` VALUES ('','F503', '15', '0', '5', '0', '1', '1', '2', null, null);
//        INSERT INTO `containers` VALUES ('','E503', '15', '0', '6', '0', '1', '0', '2', null, null);
//        INSERT INTO `containers` VALUES ('','D503', '15', '0', '7', '0', '1', '1', '2', null, null);
//        INSERT INTO `containers` VALUES ('','C503', '15', '0', '8', '0', '1', '0', '2', null, null);
//        INSERT INTO `containers` VALUES ('','B503', '15', '0', '9', '0', '1', '1', '2', null, null);
//        INSERT INTO `containers` VALUES ('','A503', '15', '0', '10', '0', '1', '0', '2', null, null);
    }


}
