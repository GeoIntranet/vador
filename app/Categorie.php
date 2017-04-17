<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categories';
    protected $primaryKey  = 'famille';
    public $incrementing = false;
    public $timestamps = false;

    public $fillable =[
        'therm',
        'mic',
        'pisto',
        'las',
        'mat',
        'as',
        'jet',
        'tps',
        'mo',
    ];

    public function getFillable()
    {
        return $this->fillable;
    }

    public function scopeCategorieSelected($query,$pagination,$filtred,$filter)
    {

        if($filtred == true )
        {
            $query = $query->where($filter,'1');
        }

        if($pagination == true )
        {
            $query = $query->paginate(13);
        } else {
            $query = $query->get();
        }

        return $query;

    }

}
