<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $primaryKey = 'id_po';

    protected $connection = "eurocomputer" ;

    protected $table = 'po';

    protected $relations;

    protected $attributes;
}
