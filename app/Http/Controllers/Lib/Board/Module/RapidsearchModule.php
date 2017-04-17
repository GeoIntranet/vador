<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/02/2017
 * Time: 18:41
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Achat;
use App\Commande;
use App\Incident;
use App\PriceAsk;
use Illuminate\Support\Facades\Redis;

class RapidsearchModule extends Module
{

    public $data;
    public $incident;
    public $achat;
    public $commande;
    public $price;

    /**
     * RapidsearchModule constructor.
     */
    public function __construct(
        Incident $incident,
        Achat $achat ,
        Commande $commande,
        PriceAsk $price
    )
    {
        $this->incident = $incident;
        $this->achat = $achat;
        $this->commande = $commande;
        $this->price = $price;

        parent::__construct();
        $this->data = [];
    }

    public function handle()
    {


        $this
            ->infoIncident()
            ->infoDa()
            ->infoPrix()
            ->infoActionCrm()
            ->infoCommandeEnCours()
            ;
        return $this->data;
    }

    private function infoIncident()
    {
        $this->userActif();
        $this->nonLu();
        $this->actif();

        return $this;
    }

    public function infoDa()
    {
        $cache = Redis::get('da.encour');

        if( ! $cache )
        {
            $this->data['daEncours'] = $this->achat->actif()->count() ;
            Redis::set('da.encour',serialize($this->data['daEncours']));
        }
        else
        {
            $this->data['daEncours'] =  unserialize(Redis::get('da.encour'));
        }

        return $this;
    }

    public function infoPrix()
    {
        $cache = Redis::get('dp.'.$this->user);

        if( ! $cache )
        {
            $this->data['dpEncours'] = $this->price->ask($this->user)->count() ;
            Redis::set('dp.'.$this->user,serialize($this->data['dpEncours']));
        }
        else
        {
            $this->data['dpEncours'] =  unserialize(Redis::get('dp.'.$this->user));
        }

        return $this;
    }

    public function infoActionCrm()
    {
        $this->data['actionEncours'] = 15 ;
        return $this;
    }

    public function infoCommandeEnCours()
    {
        $cache = Redis::get('commande.encour');

        if( ! $cache )
        {
            $this->data['commandeEncours'] = $this->commande->active()->count() ;
            Redis::set('commande.encour',serialize($this->data['commandeEncours']));
        }
        else
        {
            $this->data['commandeEncours'] =  unserialize(Redis::get('commande.encour'));
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function userActif()
    {
        $key = 'incident.user.'.$this->user.'.actif';
        $cache = Redis::get($key);

        if( ! $cache )
        {
            $this->data['incidentUserActif'] = $this->incident->actif($this->user)->count();
            Redis::set($key,serialize($this->data['incidentUserActif']));
        }
        else
        {
            $this->data['incidentUserActif'] =  unserialize($cache);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function nonLu()
    {
        $key = 'incident.user.'.$this->user.'.nonlu';
        $cache = Redis::get($key);

        if( ! $cache )
        {
            $this->data['incidentNonLu'] = $this->incident->NonLu($this->user)->count();
            Redis::set($key,serialize($this->data['incidentNonLu']));
        }
        else
        {
            $this->data['incidentNonLu'] =  unserialize($cache);
        }

        return $this;
    }

    public function actif()
    {
        $key = 'incident.all.actif';
        $cache = Redis::get($key);

        if( ! $cache )
        {
            $this->data['incidentActif'] =$this->incident->actif()->count();
            Redis::set($key,serialize($this->data['incidentActif']));
        }
        else
        {
            $this->data['incidentActif'] =  unserialize($cache);
        }

        return $this;
    }

}