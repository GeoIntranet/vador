<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class TemplateRight extends Model
{

    protected $table ='template_rights';
    protected $fillable = [

        'TEMPLATE_user_id',
        'TEMPLATE_id',

        'TEMPLATE_M1',
        'TEMPLATE_M1_mode',
        'TEMPLATE_M1_container',

        'TEMPLATE_M2',
        'TEMPLATE_M2_mode',
        'TEMPLATE_M2_container',

        'TEMPLATE_M3',
        'TEMPLATE_M3_mode',
        'TEMPLATE_M3_container',

        'TEMPLATE_M4',
        'TEMPLATE_M4_mode',
        'TEMPLATE_M4_container',

        'TEMPLATE_M5',
        'TEMPLATE_M5_mode',
        'TEMPLATE_M5_container',

        'TEMPLATE_M6',
        'TEMPLATE_M6_mode',
        'TEMPLATE_M6_container',

        'TEMPLATE_M7',
        'TEMPLATE_M7_mode',
        'TEMPLATE_M7_container',

        'TEMPLATE_M8',
        'TEMPLATE_M8_mode',
        'TEMPLATE_M8_container',

        'TEMPLATE_M9',
        'TEMPLATE_M9_mode',
        'TEMPLATE_M9_container',

        'TEMPLATE_M10',
        'TEMPLATE_M10_mode',
        'TEMPLATE_M10_container',

        'TEMPLATE_M11',
        'TEMPLATE_M11_mode',
        'TEMPLATE_M11_container',

        'TEMPLATE_rapidsearch',
        'TEMPLATE_google',

        'TEMPLATE_news',
        'TEMPLATE_news_mod',

        'TEMPLATE_fav',
        'TEMPLATE_fav_mod',
    ];


    public function scopeUserRight($query ,$user){

        $query =  $query
            ->where('TEMPLATE_user_id',$user);

        return $query;

    }



}
