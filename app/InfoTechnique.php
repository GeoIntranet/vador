<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoTechnique extends Model
{
    protected $connection ="eurocomputer";

    protected $table ='it_it';

    protected $dates=[
        'lastact',
    ];

    protected $relations ;

    /**
     * InfoTechnique constructor.
     */
    public function __construct()
    {

    }


}
