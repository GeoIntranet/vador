<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Cumule extends Model {

    protected $table='cumules';

    protected $fillable = [
        'CUMULE_user' ,
        'CUMULE_dt' ,
        'CUMULE_rec' ,
        'CUMULE_rec_maj' ,
        'CUMULE_hp' ,
        'CUMULE_hp_maj' ,
        'CUMULE_hnp' ,
        'CUMULE_cp' ,
        'CUMULE_ef' ,
        'CUMULE_rec_solde' ,
        'CUMULE_hp_solde' ,
        'CUMULE_hnp_solde' ,
        'CUMULE_cp_solde' ,
        'CUMULE_ef_solde' ,
        'CUMULE_CP_ENCOUR' ,


    ];

    /**retourne les dernieres informations du cumule de l'utilisateur indiqué.
     * @param $user
     * @return mixed
     */
    public function lastCumule($user){
        return DB::table($this->table)
            ->where('CUMULE_user',$user)
            ->OrderBy('CUMULE_dt','DESC')
            ->take(1)
            ->first();
    }

    /**
     * retourne les dernieres informations du cumule de l'utilisateur indiqué.
     * @param $query
     * @return mixed
     */
    public function scopeLastCumule($query){
        return $query = $query
            ->OrderBy('CUMULE_dt','DESC')
            ->take(1)
            ->first();
    }

    /** Verifie si un cumule EXISTE et le retourne , sinon retourne FALSE;
     * @param $id
     * @param $dt
     * @return bool
     */
    public function presentCumule($id,$dt){

        $dt = is_object($dt) ? $dt->format('y-m-d') : $dt;
        $present = DB::table($this->table)
            ->where('CUMULE_user',$id)
            ->where('CUMULE_dt',$dt)
            ->first();
        return ($present <> NULL) ? $present : FALSE;
    }

    public function intervalleCumule($dts,$dte){

        $dts = is_object($dts) ? $dts->format('y-m-d') : $dts;
        $dte = is_object($dte) ? $dte->format('y-m-d') : $dte;

        $present = DB::table($this->table)
            ->whereBetween('CUMULE_dt',[$dts,$dte])
            ->orderBy('CUMULE_dt','ASC')
            ->orderBy('CUMULE_user','ASC')
            ->get();

        return ($present <> NULL) ? $present : FALSE;
    }

}
