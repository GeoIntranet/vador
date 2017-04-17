<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delais extends Model
{

    protected $primaryKey='id_cmd';


    public function scopeSearchDelaisIn($query , $listOfBls)
    {
        $bl = is_object($listOfBls) ? $listOfBls->toArray() : $listOfBls;

        return $query
            ->select('*')
            ->whereIn('id_cmd',$bl)
            ->orderBy('id_cmd','asc')
            ->get()
            ;
    }
}
