<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MongoDB\Driver\Query;

class ArticleAs extends Model
{
    protected $table = 'articles';
    protected $primaryKey  = 'article';
    public $incrementing = false;

    public function scopeArticleInFamille($query ,$famille,$withStar=false)
    {
        $query = $query->select('famille','article','designation') ->where('famille',$famille);

        $query = $withStar == false ? $query->where('designation' ,'<>' , '') : $query  ;

        $query = $query->orderBy('article','ASC');

        return $query;

   }
}
