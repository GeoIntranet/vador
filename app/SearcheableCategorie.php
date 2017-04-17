<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 22/08/2016
 * Time: 13:58
 */

namespace App;


trait SearcheableCategorie
{

    protected $cat;
    protected $model;
    protected $query;


    public function scopeSearch($query)
    {

        if( ! $this->isMultiple()){
            //return  $query->where($this->categorie, '=' , '1');
        }

        //$this->getDifferentsCategories($query);

    }

    public function isMultiple()
    {
        return is_array($this->categories) ? TRUE : FALSE;
    }

    public function getDifferentsCategories($query)
    {
        foreach ($this->categories as $categorie) {
            //$query = $query->where($categorie, '=' , '1');
        }

        //return $query;
    }




}