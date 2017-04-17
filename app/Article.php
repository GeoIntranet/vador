<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles2';
    protected $connection = 'eurocomputer';
    protected $primaryKey  = 'id_article';
    public $incrementing = false;

    /**
     * une famille d'article a plusieur article
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article','article','article');
    }

    /**
     *une famille d'article a une categorie
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categorie()
    {
        return $this->hasOne('App\TagCategorie');
    }

    public function scopeList($query , $array)
    {
        $query = $query
            ->select('short_desc','art_model')
            ->whereIn('art_model',$array)
            ->pluck('short_desc','art_model')
        ;

        return $query;
    }

    public function scopeArticleSpecification($query, $model)
    {
        return $query
            ->select('art_model','art_type','art_marque','short_desc')
            ->where('art_model',$model)
            ->first()
            ;
    }

    public function idLocator()
    {
        return $this->hasMany('App\Stock','article','art_model');
    }

    public function achats()
    {
        return $this->hasMany('App\Achat','ref','art_model');
    }
}
