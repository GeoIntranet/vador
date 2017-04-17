<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoCommande extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='it_bl';

    protected $primaryKey ='id_it';

    protected $dates=[
        'lastact',
    ];

    protected $relations ;

    /**
     * InfoTechniqueBl constructor.
     */
    public function __construct()
    {
    }
}
