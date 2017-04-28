<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{

    public function favorited()
    {
        return $this->morphTo();
    }
}
