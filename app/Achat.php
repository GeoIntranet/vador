<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Achat extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='pd';


    public function __construct()
    {

    }

    public function ScopesearchAchatInList($query ,$daList)
    {
        return $query
            ->select('*')
            ->whereIn('id_pd',$daList)
            ->get();

    }

    public function ScopeSearchAchatByCmd($query,$blList)
    {
        return $query
            ->select('*')
            ->whereIn('id_cmd',$blList)
            ->get();
    }

    public function scopeSearchFromBl($query , $bl)
    {
        return $query
            ->select('*')
            ->whereIn('id_cmd', $bl)
            ->get();
    }


    public function scopeSearchFromDa($query , $da)
    {
        return $query
            ->select('*')
            ->whereIn('id_pd',$da)
            ->get();
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
}
