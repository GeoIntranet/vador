<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='client';

    protected $primaryKey ='id_client';

    protected $attributes;
    public $incrementing = false;
    protected $dates=[
        'date_crea'
    ];

    protected $relations ;

    public function __construct()
    {
        $this->relations['user']= ' id_vendeur ';
    }

    public function scopeCommercial()
    {
        return  User::find($this->getAttribute('id_vendeur'));
    }

    public function scopeNameClient($query , $clients)
    {
        $query = $query->select('nsoc','id_client');
        $query = $query->whereIn('id_client',$clients);
        return $query->pluck('nsoc','id_client');
    }

    public function scopeCp($query,$client)
    {
        return $query->select('cp','id_client')
            ->whereIn('id_client',$client)
            ;
    }


}
