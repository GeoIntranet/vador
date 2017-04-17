<?php

namespace App\Http\Controllers;

use App\ArticleAs;
use App\Categorie;
use App\Http\Controllers\Lib\Gestion;
use App\Http\Controllers\Lib\Categorie\CategorieGestion;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class FamilleController extends Gestion
{
    /**
     * @var Categorie
     */
    protected $categorieModel;
    protected $categorieGestion;

    /**
     * Famillecontroller constructor.
     */
    public function __construct(Categorie $categorie, CategorieGestion $categorieGestion )
    {
        $this->categorieModel = $categorie;
        $this->categorieGestion = $categorieGestion;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pagination = Session::has('familleControllerPaginationCat') ? true : false;
        $filtred= Session::has('familleControllerFiltreCat') ? true : false;
        $filtre = $filtred == true  ? Session::get('familleControllerFiltreCat') : null ;
        $categories = $this->categorieModel->categorieSelected($pagination,$filtred,$filtre);
        $categorieGlobal = $this->getCategorieGlobal();
        $categorieGlobal = collect($categorieGlobal)->forget(['mo'])->forget(['tps']);
        return view('stat.famille.famille')
            ->with('categories',$categories)
            ->with('categorieName', $categorieGlobal)
            ->with('request',$request)
            ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id , Request $request , ArticleAs $articleAs)
    {

       $categories = Categorie::where('famille',$id)->first();

        if($categories === null)
        {
            return redirect()->back();
        }

        $articles = $articleAs->ArticleInFamille($id,true);
        $categorieGlobal = $this->getCategorieGlobal();
        $fillable = $this->categorieModel->getFillable();

        return view('stat.famille.familleShow')
            ->with('categories',$categories)
            ->with('articles',$articles)
            ->with('categorieName', $categorieGlobal)
            ->with('fillables', $fillable)
            ->with('request',$request)
            ->with('id',$id)
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
        $categorieFillable = collect($this->categorieModel->getFillable());

        $input = collect(Input::all())->except(['_token','_method']);

        foreach ($categorieFillable as $k => $v)
        {
            $categorieFillable[$v] = isset($input[$v]) ? 1 : 0 ;
            $categorieFillable->forget($k);
        }

        $this->categorieModel
            ->where('famille',$id)
            ->update($categorieFillable->toArray());
        ;

        return redirect()->back();
    }

    /**
     * @param Session $session
     * @param $cat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setFiltreCat(Session $session ,$cat)
    {
        $cat_ = collect($this->getCategorieDB())->flip();
        if( ! $cat_->has($cat) ) $cat ='all';

        if( $cat <> 'all')
        {
            $session::put('familleControllerFiltreCat', $cat);
            return redirect()->action('FamilleController@index');
        }

        $session::forget('familleControllerFiltreCat');
        return redirect()->action('FamilleController@index');
    }

    public function setPaginationCat(Session $session, $state)
    {
        if($state == 'true')
        {
            $session::put('familleControllerPaginationCat', true);
        }

        if($state == 'false')
        {
            $session::forget('familleControllerPaginationCat');
        }

        return redirect()->back();
    }
}
