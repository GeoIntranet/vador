<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $connection ="eurocomputer";
    protected $table ='keyword';


    public function scopeEmplacementAll($query)
    {
        return $query->select('keyword')->where('type','loca')->pluck('keyword');
    }


}
