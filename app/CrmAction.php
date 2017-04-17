<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmAction extends Model
{
    public $table ='crm_action';
    public $connection ='eurocomputer';

    public function scopeLast($query,$limit = 5)
    {
        return $query
            ->leftJoin('client', 'crm_action.id_client', '=', 'client.id_client')
            ->select('crm_action.id_client','crm_action.type_action','crm_action.info','crm_action.creat','client.nsoc','crm_action.id_client')
            ->orderBy('creat','DESC')
            ->take(5)
            ->get()
        ;
    }
}
