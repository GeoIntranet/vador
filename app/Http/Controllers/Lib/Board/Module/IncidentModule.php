<?php
namespace App\Http\Controllers\Lib\Board\Module;

use App\Incident;
use Illuminate\Support\Facades\Redis;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 29/01/2017
 * Time: 22:57
 */
class IncidentModule extends Module
{
    /**
     * @var Incident
     */
    public $incident;


    /**
     * IncidentModule constructor.
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
        $this->module = [];
        $this->name = 'mIncident';

        parent::__construct();
    }

    public function handle()
    {
        $this->logic();

        return $this->module;
    }

    /**
     * @return mixed
     */
    private function incidentNonLu()
    {
        return $this->incident->nonLu($this->user)->count();
    }

    /**
     * @return mixed
     */
    public function incidentActif($id=null)
    {
        return $this->incident->actif($id)->count();
    }

    private function logic()
    {
        $this->last();
        $this->nonLu();
        $this->actif();

    }

    private function toFitData($data)
    {

        foreach ($data as $k => $v)
        {
            $this->module['data'][]=
                [
                    'id' => $v->id_incid,
                    'titre' =>strip_tags ($v->titre),
                    'etat' =>strip_tags ($v->level_incid),
                    'dt' =>$v->lastact,
                ];
        }
    }

    public function last()
    {
        $key = 'incident.all.last';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->incident->LastIncident();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        $this->toFitData($data);
    }

    public function nonLu()
    {
        $key = 'incident.user.'.$this->user.'.nonlu';

        $cache = Redis::get($key);
        if( ! $cache)
        {
            $data = $this->incidentNonLu();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        $this->module['nonLu'] = $data;
    }

    public function actif()
    {
        $id = $this->user;

        $key = 'incident.user.'.$id.'.actif';

        $cache = Redis::get($key);
        if( ! $cache)
        {
            $data = $this->incidentActif($this->user);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        $this->module['actif'] = $data;
    }

    public function allActif()
    {

        $key = 'incident.all.actif';

        $cache = Redis::get($key);
        if( ! $cache)
        {
            $data = $this->incidentActif();
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        $this->module['allActif'] = $data;
    }
}