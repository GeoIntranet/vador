<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achat extends Model
{
    protected $primaryKey = 'id_pd';
    protected $connection = "eurocomputer" ;
    protected $table ='pd';
    protected $relations;
    public $timestamps = false;
    protected $attributes;


    public function __construct()
    {

    }

    /**
     * recherche une liste de demande d'achats
     * @param $query
     * @param $daList
     * @return mixed
     */
    public function ScopesearchAchatInList($query ,$daList)
    {
        return $query
            ->select('*')
            ->whereIn('id_pd',$daList)
            ->get();

    }

    /**
     * recherches les da associer a une liste de bl
     * @param $query
     * @param $blList
     * @return mixed
     */
    public function ScopeSearchAchatByCmd($query,$blList)
    {
        return $query
            ->select('*')
            ->whereIn('id_cmd',$blList)
            ->get();
    }

    /**
     * recherche da associé a UN bl
     * @param $query
     * @param $bl
     * @return mixed
     */
    public function scopeSearchFromBl($query , $bl)
    {
        return $query
            ->select('*')
            ->whereIn('id_cmd', $bl)
            ->get();
    }

    /**
     * recherche une da
     * @param $query
     * @param $da
     * @return mixed
     */
    public function scopeSearchFromDa($query , $da)
    {
        return $query
            ->select('*')
            ->whereIn('id_pd',$da)
            ->get();
    }

    /**
     * recherche les da associé a un / des users
     * @param $query
     * @param $users
     * @return mixed
     */
    public function scopeAcheteurs($query , $users)
    {
        return $query
            ->select('*')
            ->whereIn('crea_id_user',$users)
            ->WherenotIn('in_etat',['X','R','A'])
            ;
    }
    
    
    public function scopeListDa($query , $array){

        $ids_ordered = implode(',', $array);

        $query  = $query
            ->select('ref','description','id_pd')
            ->whereIn('id_pd',$array)
            ->orderByRaw(DB::raw("FIELD(id_pd, $ids_ordered)"))
            ->get();

        return $query;

    }

    public function scopeActif($query)
    {
        return $query -> WherenotIn('in_etat',['X','C','R','A']);
    }

    public function articleBuy()
    {
        return $this->belongsTo('App/Article','art_model','ref');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class,'id_cmd','id_cmd');
    }

    public function action()
    {
        return $this->hasMany(AchatAction::class,'id_pd','id_pd');
    }

    public function po()
    {
        return $this->hasOne(PO::class,'po_id','id_po');
    }
}
