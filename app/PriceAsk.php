<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceAsk extends Model
{
    public $table = 'dp';
    public $connection = 'eurocomputer';

    public function scopeAsk($query , $user = null )
    {
        if($user <> null ) $query = $query ->where('dp_in_id_user',$user) ;

        $query = $query ->where('dp_etat','=','D');

        return $query ;
    }
}
