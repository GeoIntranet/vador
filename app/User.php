<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use DB;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{

    protected $attributes;
    protected $relations;
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'users';


    /**
     * @var string
     */
    protected $primaryKey = 'USER_id';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'USER_nom' ,
        'USER_id',
        'USER_prenom',
        'USER_name',
        'name',
        'email',
        'password',
        'USER_lognec',
        'USER_postefixe',
        'USER_postemobil',
        'USER_postedef',
        'USER_gsmboulot',
        'USER_telperso',
        'USER_datenais',
        'USER_fonction',
        'USER_divers',
        'USER_photo',
        'USER_icone',
        'USER_tech_divers',
        'USER_type',
        'USER_t_com',
        'USER_t_crm',
        'USER_t_tech',
        'USER_t_in',
        'USER_t_art',
        'USER_t_prix',
        'USER_t_dp',
        'USER_po_ref_sp',
        'USER_po_valid',
        'USER_po_acheteur',
        'USER_nss',
        'USER_dt_in',
        'USER_cdi',
        'USER_cdd',
        'USER_cdd_dt',
        'USER_g',
        'USER_compagny',
        'USER_section',
    ];

    /**
     * @var
     */
    public $today;


    /**
     *
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = [ 'remember_token', ];

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->relations=[
            'auditeur' => 'locator.aud_id_user',
            'createur' => 'locator.in_id_user',
            'sorteur' => 'locator.out_id_user',
            'client' => 'client.id_vendeur',
            'vendeur' => 'commandes.id_vendeur',
            'preparateur' => 'commandes.id_prepar',
            'createurIncident' => 'incident.id_tech',
        ];
    }


    /**
     * @return array
     */
    public function getFillable(){
        return $this->fillable;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function right() {
        return $this->hasOne('App\Rights','right_user_id');
    }

    /**
     * @return mixed
     */
    public function userListHoraire(){
        $today = new Carbon();
        return DB::table('horraires')
            ->select('user')
            ->where('date_r','>',$today->subMonths(3))
            ->distinct()
            ->pluck('user','user');
    }


    /**
     * Retoune les entre d'article pour un utilisateur sur un intervall de date
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeArrivee($query,$time = '2016-01-01 00:00:00'){

        return $query = Stock::query()
            ->select('locator.id_locator','locator.article','locator.out_datetime','locator.in_datetime','locator.aud_datetime')
            ->where('locator.out_datetime','>',$time)
            ->where($this->relations['createur'],$this->getAttribute('id'));

    }

    /**
     * Retoune les sortie d'un utilisateur sur une intervall de date
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeSortie($query,$time = '2016-01-01 00:00:00'){

         $query = Stock::query()
            ->select('locator.id_locator','locator.article','locator.out_datetime','locator.in_datetime','locator.aud_datetime')
            ->where($this->relations['sorteur'],$this->getAttribute('id'));

        if(is_array($time))
        {
            $query = $query->whereBetween('locator.out_datetime',[$time['intervalle']['begin']->format('Y-m-d') ,$time['intervalle']['end']->format('Y-m-d')]);

        } else{
            $query = $query->where('locator.out_datetime','>',$time);
        }

        return $query;


    }

    /**
     * Retoune audit d'un utilisateur sur une intervall de date
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeAudit($query,$time = '2016-01-01 00:00:00'){

        return $query = Stock::query()
            ->select('locator.id_locator','locator.article','locator.out_datetime','locator.in_datetime','locator.aud_datetime')
            ->where('locator.out_datetime','>',$time)
            ->where($this->relations['auditeur'],$this->getAttribute('id'));

    }

    /**
     *
     * @param $query
     * @return mixed
     */
    public function scopeClient($query)
    {
        return $query = Client::query()
            ->select('client.id_client','client.nsoc')
            ->where($this->relations['client'],$this->getAttribute('id'));
    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     *
     */
    public function scopeVente($query,$time = '2016-01-01 00:00:00')
    {
        return $query = Commande::query()
            ->select('commandes.id_cmd')
            ->where('commandes.date_cmd','>',$time)
            ->where($this->relations['vendeur'],$this->getAttribute('id'));
    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopePreparation($query,$time = '2016-01-01 00:00:00')
    {
        return $query = Commande::query()
            ->select('commandes.id_cmd')
            ->where('commandes.date_cmd','>',$time)
            ->where($this->relations['preparateur'],$this->getAttribute('id'));
    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeLigneCommandes($query , $time = '2016-01-01 00:00:00')
    {
        $cmd = $this->Vente()->pluck('id_cmd');

        return $query = LigneCommande::query()
            ->select('cmd_lignes.code_article','cmd_lignes.id_cmd')
            ->whereIn('id_cmd',$cmd);

    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeCreationIncident($query,$time = '2016-01-01 00:00:00')
    {
        return $query = Incident::query()
            ->select('incident.id_incid')
            ->where('id_tech',$this->getAttribute('id'));

    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeParticipationIncident($query,$time = '2016-01-01 00:00:00')
    {
        return $query = Incident::query()
            ->select('incident.id_incid')
            ->where('explic', 'like', '%'.$this->getAttribute('USER_prenom').'%');
    }

    /**
     * @return mixed
     */
    public function scopeInfoTechnique()
    {
        return $query = InfoTechnique::query()
            ->select('it_it.titre','it_it.explic')
            ->where('id_tech',$this->getAttribute('id'))
            ->orderBy('lastact','DESC')
            ;
    }

    /**
     * @return mixed
     */
    public function scopeInfoClient()
    {
        return $query = InfoClient::query()
            ->select('it_it.id_client','it_client.explic')
            ->where('id_tech',$this->getAttribute('id'))
            ->orderBy('lastact','DESC')
            ;
    }

    /**
     * @return mixed
     */
    public function scopeInfoCommande()
    {
        return $query = InfoCommande::query()
            ->select('it_bl.info_prod','id_cmd')
            ->where('id_tech',$this->getAttribute('id'))
            ->whereNotNull('it_bl.info_prod')
            ->orderBy('lastact','DESC')
            ;
    }

    /**
     *
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeAchat($query,$time = '2016-01-01 00:00:00')
    {
        return $query = AchatAction::query()
            ->select('id_pd')
            ->where('id_user',$this->getAttribute('id'))
            ->where('dt_pd_action','>' ,$time)
            ->distinct()
            ->orderBy('dt_pd_action','DESC')
            ;
    }

    /**
     * @param $query
     * @param string $time
     * @return mixed
     */
    public function scopeOrder($query,$time = '2016-01-01 00:00:00')
    {
        return $query = Order::query()
            ->select('po_id')
            ->where('po_user_id_creat',$this->getAttribute('id'))
            ->where('po_dt_cmd','>' ,$time)
            ->orderBy('po_dt_cmd','DESC')
            ;
    }


    public function scopeActif($query)
    {
        return $query->where('USER_type','>',0);
    }



}
