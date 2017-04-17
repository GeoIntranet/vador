<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoClient extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='it_client';

    protected $dates=[
        'lastact',
    ];

    protected $relations ;

    /**
     * InfoTechniqueClient constructor.
     */
    public function __construct()
    {
    }


}
