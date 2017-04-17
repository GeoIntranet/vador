<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LigneCommande extends Model
{
    protected $connection='eurocomputer';

    protected $table='cmd_lignes';
    protected $primaryKey='id_cmd';

    //protected $relations;

    /**
     * LigneCommande constructor.
     */
    public function __construct()
    {

    }

    public function scopeCommandLastOuvrable($query,$date)
    {
        return $query
            ->select('*')
            ->where($this->relations['dateVente'])
            ;
    }

    public function scopeCommandPrice($query ,$arrayBl)
    {
        return $query
            ->select(DB::raw('id_cmd, Sum(qte_livr * prix_unit) AS total'))
            ->whereIn('id_cmd',$arrayBl)
            ->groupBy('id_cmd')
            ->pluck('total','id_cmd')
            ;
    }

    public function scopeligneCommandeDelais($query,$arrayBl)
    {
        return $query
            ->select('id_cmd','type_article','code_article','desc_article','qte_cmd')
            ->whereIn('id_cmd',$arrayBl)
            ->get()
            ;
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class,'id_cmd','id_cmd');
    }


}
