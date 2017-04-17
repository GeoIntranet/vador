<?php

namespace App;

use App\Http\Controllers\Lib\Locator\LocatorRepositoryInterface;
use App\SearcheableCategorie;
use Illuminate\Database\Eloquent\Model;

class Container extends Model implements LocatorRepositoryInterface
{

    protected $table = 'containers';
    protected $primaryKey = 'id_locator';
    public $incrementing = false;

    /**
     * retourne les articles assorciés a un emplacement
     * ForeignKey = locator_id
     * localKey = id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article','locator','name');
    }



    /**
     * Nous retourne le nombre de container enregistrer
     * @param $query
     * @return mixed
     */
    public function scopeElementLocator( $query )
    {
        return $query->count();
    }

    /**
     * Retourne les clef d'un subContainer
     * @param $query
     * @return mixed
     */
    public function scopeSubKey( $query )
    {
        return $query->GroupBy('sub')->lists('sub');
    }

    /**
     * Retourne les valeur , d'un subContainer donné.
     * @param $query
     * @param $sub
     * @return mixed
     */
    public function scopeSubValue($query , $sub)
    {
        return $query->where('sub',$sub)->orderBy('row','ASC')->orderBy('col','ASC')->get()->toArray();
    }



}
