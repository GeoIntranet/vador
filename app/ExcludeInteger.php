<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcludeInteger extends Model
{


    protected $table = 'exclude_integer';

    public $timestamps = false;
    protected $fillable = [
        'bl',
        'commande_ligne',
        'id_user',
        'code_as',
        'designation',
    ];
}
