<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteLink extends Model
{
    public $table = 'favorite_links';

    public function scopeUser($query , $id)
    {
        return $query ->where('id_user',$id) ;

    }
}
