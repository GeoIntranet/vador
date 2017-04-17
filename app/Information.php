<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;


class Information extends Model
{

    public  $dt;

    function __construct()  {
        $this->dt = new Carbon();
    }

    /**
     * Retourne les user ABSENT ACTUELLEMENT
     * @return mixed
     */
    public function Absent(){

        $ABS = DB::connection('eurocomputer')
            ->table('in_out')
            ->leftJoin('utilisateur', 'in_out.id_utilisateur_out', '=', 'utilisateur.id_utilisateur')
            ->select('*')
            ->where('dt_out','<',$this->dt)
            ->where('dt_in','>',$this->dt)
            ->get() ;
        return $ABS;
    }

    /**
     * Retourn les date de naissance de tout les utilisateur NON-NULL
     * @return mixed
     */
    public function dtAnniversaire(){

        $anniversaire = DB::table('users')
            ->select( 'USER_datenais','USER_nom','USER_prenom')
            ->whereNotNull('USER_datenais')
            ->get();
        return $anniversaire;
    }
}
