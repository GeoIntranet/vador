<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;

class Horaire extends Model {



    public $horaire;
    public $today;
    public $users;
    public $horaireUsers;
    public $horaireInt;

    protected $table='horraires';

    protected $dates =[
        'date_j',
        'date_r',
        'created_at',
        'update_at',
    ];

    protected $fillable = [
        'user' ,
        'date_r',
        'heures_taff',
        'com',
        'recup',
        'heure_paye',
        'cp',
        'cp2',
        'ef',
        'hnp',
    ];

    function __construct(){
        $this->today = New Carbon();
    }

    /** retourne les horraire de l'utilisateur les 4 dernière semaine.
     * @param $user
     * @return mixed
     */
    public function getHorraire($user){

        return $this->horaire = DB::table($this->table)
            ->where('user',$user)
            ->where('date_r','>',$this->today->subWeeks(5))
            ->get();
    }

    public function getUserDistinct() {
        return $this->users = DB::table('users')
            ->select('USER_id')
            ->where('USER_type','>','0')
            ->whereNotIn('USER_id',[10,14,17])
            ->distinct()
            ->pluck('USER_id');
    }

    public function getHorraireUsers($users){

        return $this->horaireUsers = DB::table($this->table)
            ->select('*')
            ->whereIn('user',$users)
            ->where('date_r','>=',$this->today->subWeeks(5))
            ->orderBy('date_r','ASC')
            ->get();
    }

    public function getHoraireInt($user,$dtS,$dtE){

        $int =  DB::table($this->table)
            ->select('*')
            ->whereBetween('date_r',[$dtS,$dtE])
            ->orderBy('date_r','ASC');
        $int = is_array($user) ? $int->whereIn('user',$user) : $int->where('user',$user) ;
        $int=$int->get();

        return $int;
    }

    public function scopelastDateCheck($query , $user)
    {
        return $query->where('user',$user)->orderBy('date_r','DESC')->first();
    }

}
