<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AchatAction extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='pd_action';


    /**
     * retourne les differentes action
     * @param $query
     * @param $list
     * @return mixed
     */
    public function ScopesearchActionInList($query,$list)
    {
        return $query
            ->select('*')
            ->whereIn('id_pd',$list)
            ->get()
        ;
    }

    /**
     * Recherche des 5 dernieres actions effectuer sur les DA
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function scopeLast($query, $limit = 5)
    {

        $query = $query
            ->select('id_pd','dt_pd_action')
            ->orderBy('dt_pd_action','DESC')
            ->limit(0)
            ->take($limit)
            ->get()  ;

        return $query;
    }

    public function achat()
    {
        return $this->belongsTo(Achat::class,'id_pd','id_pd');
    }

}
