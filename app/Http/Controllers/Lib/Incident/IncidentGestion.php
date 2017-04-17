<?php
namespace App\Http\Controllers\Lib\Incident ;


use App\Incident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 22/02/2017
 * Time: 21:16
 */
class IncidentGestion extends IncidentConstante
{
    public $incident;
    public $incidents;
    public $data;
    public $warning;

    public $specificIncident;
    public $start;
    public $end;
    public $post;

    /**
     * IncidentGestion constructor.
     */
    public function __construct(Incident $incident)
    {
        parent::__construct(app('App\user'));
        $this->user = Auth::user()->id;
        $this->incident = $incident;
        $this->data = [];
        $this->incidents = [];
        $this->warning = [];
    }

    public function handleAllUser()
    {
        $incidents = collect( $this->incident->actif()->orderBy('lastact','DESC')->get() );

        $this->dispatchByUser($incidents);

        $data = $this->countEtat($this->data);

        $data = ['data' => $data , 'warning' => $this->warning,'incident' => $this->incidents];

        return  $data;

    }

    public function handleUser($mode = 'index')
    {
        $incidents = [];

        if($mode == 'index' )
        {

            $this->incidents =
                ( ! empty ($this->incidents[$this->user]) )
                    ?
                    $this->incidents[$this->user] : $this->incident->actif( $this->user )->orderBy('lastact','DESC')->get()
            ;
        }

        if($mode == 'session' )
        {
            $this->user = $this->getUser();

            $this->incidents =
                ( ! empty ($this->incidents[$this->user]) )
                    ?
                    $this->incidents[$this->user] : $this->incident->actif( $this->user )->orderBy('lastact','DESC')->get()
            ;
        }

        if($mode == 'preference' )
        {
            $name = 'h_incident_'.$this->user;

            if( ! empty(Redis::HGETALL($name)))
            {
                $redisIncident = collect(Redis::HGETALL($name))
                    ->reverse()
                    ->take(24);

                $this->redisIncidentPreference = $redisIncident->map(function ($item, $key) {
                    return $item;
                });

                $this->incidents = $this->incident->list( $this->redisIncidentPreference )->get() ;
            }

        }

        return $this;
    }

    private function dispatchByUser($incidents)
    {
        foreach ($incidents as $index => $incident)
        {
             $this->data[$incident->id_tech][$incident->id_etat][]=$incident->id_incid ;

             $this->incidents[$incident->id_tech][] = $incident;

             if($incident->level_incid == 1) $this->warning[$incident->id_tech] = TRUE;
        }
    }

    private function countEtat($data)
    {
        $counter = [];

        foreach ($data as $user => $etat)
        {
            foreach ($etat as $index => $value)
            {
                $counter[$user][$index]=count($value);
            }
        }

        return $counter;
    }

    private function getUser()
    {
        return  session()->has('incidentViewer') ? session()->get('incidentViewer') : $this->user;
    }

    public function update($id,$input)
    {
        $format = $this->format($id, $input);
        $date = Carbon::now()->toDateTimeString();

        $this->specificIncident->update([
            'explic' => $format,
            'level_incid' => 1,
            'id_etat' => $input['action'],
            'id_tech' => $input['who'],
            'lastact' => $date,
        ]);

    }

    private function defineStart()
    {
        $now = Carbon::now();
        $date = $now->copy()->format('d/m/Y');
        $time = $now->copy()->toTimeString();
        $avatar = $this->getAvatar();

        return '<hr><b>'.$avatar.' Mise à jour d\'incident le '.$date.' à '.$time.' par ' .$this->formateReceiver().' </b><br>';
    }

    private function defineEnd($input)
    {
        $action = $this->action[$input['action']];
        return '<b>'.$action.' --> '.$this->formateReceiver($input['who']).'</b><br>';
    }


    private function formateReceiver($id = null)
    {
        //exemple - Geoffrey VALERO [48]

        $user = $id == null ? Auth::user() : $this->getSpecificUser($id);

        if($user <> null)
        {
            return  $user->USER_prenom .' '. $user->USER_nom .' ['. $this->getTel($user->id).']';
        }

        return 'Inconnu ['. Auth::user()->id.']';
    }

    private function getAvatar()
    {
        $initial = Auth::user()->name;
        $user = Auth::user()->USER_prenom.' '.Auth::user()->nom;
        $imageTitle = Auth::user()->USER_prenom.' '.Auth::user()->USER_nom.' ['.$this->getTel().']';

        return "<img src=/imgs/trombinoscope/32x32/$initial.PNG border=0 align=absmiddle title=$imageTitle>";
    }

    private function getTel($id = null)
    {
        $user = $id == null ? Auth::user() : $this->getSpecificUser($id);

        return $user->USER_postefixe == null ? $user->USER_postemobil : $user->USER_postefixe;
    }

    private function format($id, $input)
    {
        $this->start = $this->defineStart();
        $this->end = $this->defineEnd($input);

        $this->specificIncident = $this->incident->find($id);
        $contenu = $this->specificIncident->explic;

        $this->post = $contenu.$this->start.nl2br($input['body']).'</br>'.$this->end;

        return $this->post;
    }

    public function forYou($incident)
    {

        if( ( $incident->id_tech == Auth::user()->id ) AND ( $incident->level_incid == 1 ) )
        {
            $inc = Redis::keys("*incident.user.$incident->id_tech*");
            if($inc) Redis::del($inc);

            $incident->update([
                'level_incid' => 0
            ]);

        }
    }
}