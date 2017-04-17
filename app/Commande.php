<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commande extends Model
{
    protected $connection='eurocomputer';
    protected $primaryKey='id_cmd';
    protected $relations;
    protected $attributes;
    protected $dates=[
        'date_cmd',
        'date_livr',
    ];
    protected $items;

    protected $with =['ligne'];

    /**
     * Commande constructor.
     */
    public function __construct()
    {
        $this->relations['vendeur'] ='commandes.id_vendeur';
        $this->relations['preparateur'] ='commandes.id_prepar';
        $this->relations['preparateur'] ='commandes.id_prepar';
        $this->relations['facturer'] ='commandes.id_clientfact';
        $this->relations['livrer'] ='commandes.id_clientlivr';
        $this->relations['dateVente'] ='commandes.date_cmd';
    }

    public function scopeVendeur()
    {
        return User::find($this->getAttribute('id_vendeur'));
    }

    public function scopePreparateur()
    {
        return User::find($this->getAttribute('id_prepar'));
    }

    public function scopeCommandLast($query,$date)
    {
        return $query
            ->select('id_cmd','date_livr','id_clientlivr')
            ->where($this->relations['dateVente'],$date)
            ->where('etat_livr','2') ;
    }

    public function scopeCommandLastOuvrableD($query,$date,$array)
    {
       return LigneCommande::query()
           ->select('*')
           ->whereIn('id_cmd',$array)
           ;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function scopeCommandYear($query,$option)
    {
        $query = $query->select('id_cmd');
        $query = $query->whereBetween('date_livr',[$option['intervalle']['begin']->format('Y-m-d') ,$option['intervalle']['end']->format('Y-m-d')]);
        $query = $query->where('etat_livr',2);
        return $query;
    }

    public function scopeCommandSent($query , $date)
    {
        $query = $query->select('id_cmd','id_clientlivr','id_vendeur','id_clientfact','date_livr','date_cmd')
        ->whereBetween('date_livr',[$date['begin'],$date['end']])
        ->where('etat_livr',2)
        ->orderBy('date_livr','ASC');
        return $query->get();
    }

    public function scopeCountSent($query,$dt)
    {
        return $query
            ->where('date_livr','=',$dt)
            ->where('etat_livr','=','2')
        ;

    }

    public function scopeCommandSentBl($query , $bl)
    {
        $query = $query->select('id_cmd','id_clientlivr','id_vendeur','id_clientfact','date_livr','date_cmd');
        $query = $query->where('id_cmd',$bl);
        $query = $query->where('etat_livr',2);
        return $query->get();
    }

    public function scopeClientToInteger($query, $bl)
    {
        return $query->select('id_cmd','id_clientlivr','id_clientfact')
            ->whereIn('id_cmd',$bl)
            ;
    }

    public function scopeEnCours($query , $option = null)
    {


         $query = $query
            ->join('it_bl', 'commandes.id_cmd', '=', 'it_bl.id_cmd', 'left outer')
            ->join('client', 'client.id_client', '=', 'commandes.id_clientlivr', 'inner')
            ->select(
                'commandes.id_cmd',
                'commandes.cd_cmd_cli',
                'commandes.date_cmd',
                'commandes.id_vendeur',
                'commandes.id_clientlivr',
                'it_bl.info_prod'
            )
            ->whereRaw ('(commandes.id_cmd BETWEEN 2850000 and  3450000 or commandes.id_cmd BETWEEN 3850000 AND 4450000)')
            ->where('etat_livr','=','1')
            ->whereNull('it_bl.invalid')
            ;


        if($option)
        {

            $query -> orderBy ('date_cmd',$option['date']);

            if($option['user'] == 'ALL')
            {
                $query -> whereIn ('commandes.id_vendeur',$option['users']);
            }
            else
                {
                $query -> whereIn ('commandes.id_vendeur',$option['user']);
            }
        }
        else
        {
            $query -> orderBy ('date_cmd','DESC');
        }

        $query = $query->get();

        return $query;
    }

    public function scopeUniqueOrder($query,$order, $option = null)
    {
        return $query
            ->join('it_bl', 'commandes.id_cmd', '=', 'it_bl.id_cmd', 'left outer')
            ->join('client', 'client.id_client', '=', 'commandes.id_clientlivr', 'inner')
            ->select(
                'commandes.id_cmd',
                'commandes.cd_cmd_cli',
                'commandes.date_cmd',
                'commandes.id_vendeur',
                'commandes.id_clientlivr',
                'it_bl.info_prod'
            )

            ->where('commandes.id_cmd',$order)
            ->where('etat_livr','=','1')
            ->whereNull('it_bl.invalid')
            ->orderBy('date_cmd','DESC')
            ;
    }

    public function scopeMultipleOrder($query , $order , $option = null)
    {

        return $query
            ->join('it_bl', 'commandes.id_cmd', '=', 'it_bl.id_cmd', 'left outer')
            ->join('client', 'client.id_client', '=', 'commandes.id_clientlivr', 'inner')
            ->select(
                'commandes.id_cmd',
                'commandes.cd_cmd_cli',
                'commandes.date_cmd',
                'commandes.id_vendeur',
                'commandes.id_clientlivr',
                'it_bl.info_prod'
            )
            ->whereIn('commandes.id_cmd',$order)
            ->orderBy('date_cmd','DESC')
            ;
    }

    public function scopeActive($query)
    {
        return  $query
            ->join('it_bl', 'commandes.id_cmd', '=', 'it_bl.id_cmd', 'left outer')
            ->join('client', 'client.id_client', '=', 'commandes.id_clientlivr', 'inner')
            ->select(
                'commandes.id_cmd',
                'commandes.cd_cmd_cli',
                'commandes.date_cmd',
                'commandes.id_vendeur',
                'commandes.id_clientlivr',
                'it_bl.info_prod'
            )
            ->whereRaw ('(commandes.id_cmd BETWEEN 2850000 and  3450000 or commandes.id_cmd BETWEEN 3850000 AND 4450000)')
            ->where('etat_livr','=','1')
            ->whereNull('it_bl.invalid')
        ;
    }

    /**
     * retourne les ligne de commande associer a l'id commande
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ligne()
    {
        return $this->hasMany(LigneCommande::class,'id_cmd','id_cmd');
    }

    /**
     * retourne les achat lié a la commande
     * @return mixed
     */
    public function achat()
    {
        return $this->hasMany(Achat::class,'id_cmd','id_cmd');
    }

    /**
     * retourne e client de livraison pour la commande
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientDelivered()
    {
        return $this->belongsTo(Client::class,'id_clientlivr','id_client');
    }

    /**
     * retourne le client facturer de la commande
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clientFacture()
    {
        return $this->belongsTo(Client::class,'id_clientfact','id_client');
    }

    /**
     * retourne le vendeur de la commande
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendeur()
    {
        return $this->belongsTo(User::class,'id_vendeur','id');
    }
}
