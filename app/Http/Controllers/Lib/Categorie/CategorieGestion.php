<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/09/2016
 * Time: 12:23
 */

namespace App\Http\Controllers\Lib\Categorie;


use App\Categorie;
use Illuminate\Support\Facades\Redis;

class CategorieGestion
{

    protected $categorie;
    protected $redis;
    protected $categorieName;
    /**
     * CategorieGestion constructor.
     */
    public function __construct(Categorie $categorie )
    {
        $this->categorie = $categorie;
        $this->categorieName = 'CategorieController';
    }

    public function categorieAll()
    {
        return $this->categorie->all();
    }
    
    public function checkCategorie()
    {

    }

    public function calculeCategorie()
    {
        
    }

    public function categorieRedisAll()
    {
        return Redis::hgetall($this->categorieName);
    }

    public function editCategorie($categorie)
    {

    }

    public function editCategorieRedis($categorie)
    {

    }

    public function encodeJson($categorie)
    {
        return  json_encode($categorie);
    }

    public function decodeJson($categorie)
    {
        return  json_decode($categorie);
    }


}