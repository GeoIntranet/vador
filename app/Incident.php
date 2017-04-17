<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Incident extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='incident';

    protected $primaryKey ='id_incid';

    protected $attributes;
    public $timestamps = false;

    protected $dates=[
        'open',
        'lastact',
    ];

    protected $fillable =
        [
            'id_client',
            'nsoc',
            'tel',
            'adr1',
            'adr2',
            'cp',
            'ville',
            'contact',
            'id_cmd',
            'num_serie',
            'open',
            'lastact',
            'nextact',
            'level_incid',
            'id_etat',
            'id_tech',
            'id_garant',
            'titre',
            'explic',
        ];

    protected $relations ;

    /**
     * Incident constructor.
     */
    public function __construct()
    {
        $this->relations['incident'] = 'incident.id_tech';
    }

    /**
     * client lié a l'incient
     * @return mixed
     */
    public function scopeClient()
    {
        return Client::find($this->getAttribute('id_client'));
    }

    /**
     * Commande liée a l'incident
     * @return mixed
     */
    public function scopeCommande()
    {
        return Client::find($this->getAttribute('id_cmd'));
    }

    /**
     * User liée a la creation de l'incident
     * @return mixed
     */
    public function scopeUser()
    {
        return Client::find($this->getAttribute('id_tech'));
    }

    /**
     * Incidents dont l'utilisateur donnée a participé
     * @param $query
     * @param $userName
     * @param Carbon $date
     * @param string $interval
     * @return mixed
     */
    public function scopeUserIncident($query ,$userName, $interval)
    {
        return $query->select('id_incid')
            ->select('id_incid','open','titre')
            ->whereRaw(" explic LIKE '% $userName %' " )
            ->whereBetween('open',[$interval['begin']->format('Y-m-d'),$interval['end']->format('Y-m-d')])
            ->get();
    }




    public function scopeLastIncident($query,$options=null)
    {
        $query = $query
            ->orderBy('lastact','DESC')
            ->limit(0)
            ->take(5)
            ->get()
            ;
        return $query;
    }

    public function scopeActif($query,$user = null)
    {
        if( $user <> null ) $query = $query -> where('id_tech', $user) ;
         $query = $query -> where('id_etat', '<=', '7') ;

         return $query ;
    }
    public function scopeList($query,$list)
    {
        $list = $list->toArray();
        $placeholders = implode(',',array_fill(0, count($list), '?'));
        $query = $query -> whereIn('id_incid', $list)
            ->orderByRaw("field(id_incid,{$placeholders})", $list);
        return $query ;
    }
    public function scopeNonLu($query,$user)
    {
        return $query
            ->where('id_tech', $user)
            ->where('level_incid', '=', '1')
            ;
    }

}
