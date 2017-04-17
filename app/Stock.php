<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    protected $connection ="eurocomputer";

    protected $table = 'locator';

    protected $primaryKey  = 'id_locator';

    public $incrementing = false;
    public $timestamps = false;


    protected $attributes;

    protected $relations;

    protected $dates=[
        'in_datetime',
        'out_datetime',
        'aud_datetime',
    ];

    /**
     * Stock constructor.
     */
    public function __construct()
    {
        $this->relations['user']= ' test ';
    }


    /**
     * Un article appartient a un emplacement du locator
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function container()
    {
        return $this->belongsTo('App\Container');
    }

    public function scopeFamille($query)
    {
         $query = $query->whereNull('out_datetime')->pluck('article');
         return  Article::query()->select('art_marque')->distinct()->whereIn('art_model',$query);
    }

    public function scopeSortie($query,$option)
    {
        $query = $query->select('id_locator','out_datetime')
            ->where('out_id_user',$option['user']);
            $query = $query->whereBetween('out_datetime',[$option['intervalle']['begin']->format('Y-m-d') ,$option['intervalle']['end']->format('Y-m-d')]);

        return $query->pluck('out_datetime','id_locator') ;
    }

    public function scopeContributionCommand($query,$option,$user)
    {
        $query = $query->select('out_datetime','out_id_cmd','out_id_user','id_locator')
            ->wherein('out_id_user',$user);

        $query = $query->whereBetween('out_datetime',[$option['intervalle']['begin']->format('Y-m-d') ,$option['intervalle']['end']->format('Y-m-d')]);

        return $query->get();
    }

    public function scopeLastArrive($query,$options = null)
    {
        $query = $query
            ->orderBy('in_datetime','DESC')
            ->limit(0)
            ->take(5)
            ->get();

        return $query;

    }

    public function scopeToAudit($query)
    {
        return $query
            ->whereNull('out_datetime')
            ->whereNull('aud_datetime')
            ->where('in_datetime','>','2011-11-01')
            ->where('in_presta','like','%PO:%')
            ->get() ;
    }

    /**
     * retourne les empalcement favoirs locator de l'utilisateur indiqué
     * @param $user
     * @return mixed
     */
    public function emplacementFavoris($user){

        $emp = DB::table('preferences')
            ->select('PREFERENCE_content')
            ->where('PREFERENCE_user_id',$user)
            ->where('PREFERENCE_module',1)
            ->pluck('PREFERENCE_content')
        ;

        return $emp;
    }

    public function emplacement()
    {
        $emp = DB::connection('eurocomputer')
            ->table('keyword')
            ->select('keyword')
            ->where('type','loca')
        ;

        return $emp;
    }


    /**
     * retourne les machines favorite de l'utilisateur INDIQUE
     * @param $user
     * @return mixed
     */
    public function machineFavoris($user){

        $machine = DB::table('preferences')
            ->select('PREFERENCE_content')
            ->where('PREFERENCE_user_id',$user)
            ->where('PREFERENCE_module',2)
            ->pluck('PREFERENCE_content')
        ;

        return $machine;
    }

    public function articleModel()
    {
        return $this->hasOne('App\Article','art_model','article');
    }

}
