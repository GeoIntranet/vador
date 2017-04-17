<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 13/03/2017
 * Time: 12:38
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Article;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LocatorManager
{

    public $key;
    public $input;
    public $query;
    public $resultQueryFilter;


    /**
     * LocatorManager constructor.
     */
    public function __construct()
    {
        $this->key = 'locator_search_'.Auth::user()->id;
    }


    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prepareSessionSearch($request)
    {
        $this->request = $request;

        $this->input = $request->input();

        $this->resultQueryFilter = '';

        if($this->hasInput()) $this->registerSession();

        return redirect()->back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function searchEmplacement($id)
    {
        $articles = Stock::where('locator',$id)
            ->join('articles2', 'locator.article', '=', 'articles2.art_model')
            ->wherenull('out_id_user')
        ;

        return  $articles;
    }

    private function hasInput()
    {
        $this->id = $this->getId();
        $this->emplacement = $this->getEmplacement();
        $this->article = $this->getArticle();
        $this->description = $this->getDescription();

        return (($this->id <> '') | ($this->emplacement <> '') | ($this->article <> '') | ($this->description <> '')) ? TRUE : FALSE ;
    }


    private function getId()
    {
        return deleteSpace($this->input['id']);
    }

    private function getEmplacement()
    {
        return deleteSpace($this->input['emplacement']) ;
    }

    private function getArticle()
    {
        return deleteSpace($this->input['article']);
    }

    private function getDescription()
    {
        $this->description = [];

        $this->input['description'] = deleteSpaceStartAndEnd($this->input['description']);

        if($this->input['description'] !== '') $this->description = explode(' ', $this->input['description'] );

        return $this->description ;
    }

    private function registerSession()
    {
        /*
         * state :
         * 1 : neuf
         * 11 : occase
         * 21 : a reconstruire
         * 22 : hs
         * 0 : non audité
         * */

        $user = Auth::user()->id;
        $key ='locator_search_'.$user;
        $id = $this->formatID($this->id);

        $neuf = isset($this->input['1']) ? 1 : 0 ;
        $occase = isset($this->input['11']) ? 1 : 0 ;
        $reconstruire = isset($this->input['21']) ? 1 : 0 ;
        $hs = isset($this->input['22']) ? 1 : 0 ;
        $audite = isset($this->input['0']) ? 1 : 0 ;
        $out = isset($this->input['out']) ? 1 : 0 ;

        $value = [
            'id' => $id,
            'emplacement' => $this->emplacement,
            'article' => $this->article,
            'description' => $this->description,
//            'general' => $this->general,
            '1' => $neuf,
            '11' => $occase,
            '21' => $reconstruire,
            '22' => $hs,
            '0' => $audite,
            'out' => $out,

        ];

        $this->request->session()->put($key,$value);
    }


    public function  prepareQuery($session)
    {
        $this->session = $session;

        $this
            ->baseQuery()
            ->hasIdForQuery()
            ->hasEmplacementForQuery()
            ->hasArticleForQuery()
            ->hasStateForQuery()
        ;

        return $this;
    }

    public function execute()
    {
        $description = session()->get($this->key)['description'];

        if($description <> []) {
            $result = $this->getQueryFiltred($description);
            $this->query = $this->query->whereIn('id_locator',$result);
        }

        $this->query  = $this->query->get();

        $this->counter = $this->countState();

        return $this;
    }

    private function getQueryFiltred($description)
    {
        $usefullID = '';
        $toFiltre = $this->prepareDescriptionSearching() ;
        $toFiltre_ = array_keys(collect($toFiltre)->first());

        if(count($toFiltre) > 1 )
        {
            $usefullID = commonKeyArrayMulti($toFiltre);
            $toFiltre_ = array_keys($usefullID->toArray());
        }

        return $toFiltre_;
    }

    private function prepareDescriptionSearching()
    {
        $description = session()->get($this->key)['description'];
        $description = is_array($description) ? $description : explode(' ', $description);

        $resultFiltred=[];
        $freshQuery = $this->query;

        foreach ($description as  $item) {
            $result = with( clone $this->query )
                ->Where('description', 'like',  '%' . $item . '%')
            ;

            $resultFiltred[]=$result->pluck('id_locator','id_locator')->toArray();
        }

        return $resultFiltred;
    }

    private function baseQuery()
    {
        $this->query = Stock::query();

        $this->query = $this->query
            ->join('articles2', 'locator.article', '=', 'articles2.art_model')
        ;

        return $this;
    }

    private function hasIdForQuery()
    {
        if( $this->session['id'] <> '') {
            $this->query = $this->query->where('id_locator',$this->session['id']);
        }
        else{
            $this->query = $this->query->whereNull('out_id_cmd');
        }

        return $this;
    }

    private function hasEmplacementForQuery()
    {
        if( $this->session['emplacement'] <> '') $this->query = $this->query->where('locator',$this->session['emplacement']);

        return $this;
    }

    private function hasArticleForQuery()
    {
        if( $this->session['article'] <> '')
            $this->query = $this->query->Where('article', 'like',  '%' . $this->session['article'] . '%')
            ;

        return $this;
    }

    private function countState()
    {
        $total =  count($this->query);
        $counter = $this->counter();

       return
           [
                'total' => $total,
                'count' => $counter
            ] ;

    }


    private function counter()
    {
        $stateArray = [];

        foreach ($this->query as $index => $data)
        {
            $stateArray[$data->id_etat] = isset($stateArray[$data->id_etat]) ? $stateArray[$data->id_etat] + 1 : 1;
        }

        return $stateArray;
    }

    private function hasStateForQuery()
    {
        $etat = [];

        $this->session[1] == 1 ? array_push($etat,1) :'';
        $this->session[11] == 1 ? array_push($etat,11):'';
        $this->session[21] == 1 ? array_push($etat,21):'';
        $this->session[22] == 1 ? array_push($etat,22):'';

        if(! empty($etat)) $this->query = $this->query->whereIn('id_etat',$etat);

        return $this;
    }

    public function isEmptySession($session)
    {
        return
            (
                ($session['id'] == '')
                AND
                ($session['emplacement'] == '')
                AND
                ($session['article'] == '')
                AND
                ($session['description'] == [])
                AND
                ($session['id'] == '')
            )
                ?
                TRUE : FALSE;

    }

    public function searchMulti($ids)
    {
        $articles = Stock::whereIn('id_locator',$ids)
            ->join('articles2', 'locator.article', '=', 'articles2.art_model')
        ;

        return  $articles;
    }

    /**
     * permet d'autoriser dans le champ id - IDXXXX | idXXXX | XXXXX
     * @param $id
     * @return string
     */
    private function formatID($id)
    {
        $matchID = strtoupper(substr($id,0,2)) == 'ID' ? TRUE : FALSE;

        return $matchID == TRUE ? substr($id,2,strlen($id)) : $id;
    }

    public function searhEquivalentModel($art_search)
    {
        return Article::select('art_model','art_type','art_marque','short_desc')->where('art_model', 'LIKE', "%$art_search%")
            ->get()
            ;
    }

    public function OutLocator()
    {
        return app(OutCmd::class);
    }

    public function InLocator()
    {
        return app(InCmd::class);
    }

    public function multiID()
    {
        return app(MultiIDManager::class);
    }

}