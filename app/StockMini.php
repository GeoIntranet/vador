<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockMini extends Model
{
    protected $table= 'stocks_mini';
    protected $fillable =[
        'user_id',
        'article',
        'quantite',
        'comment',
    ];
}
