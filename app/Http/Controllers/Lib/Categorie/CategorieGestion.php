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
    protected $categorieRedis;
    protected $redis;
    protected $categorieName;

    /**
     * CategorieGestion constructor.
     *
     * @param \App\Categorie $categorie
     */
    public function __construct( Categorie $categorie )
    {
        $this->categorie = $categorie;
        $this->categorieName = 'CategorieController';
    }

    /**
     * retourne les catégorie en base de donné.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function categorieAll()
    {
        return $this->categorie->all();
    }

    /**
     * initialise une commande pour classement categorie
     * @param $bl
     */
    public function setCommand($bl)
    {
        $this->bl = $bl;

        return $this;
    }

    /**
     * Initialise une liste de commandes.
     * @param $bl
     */
    public function setListCommand($bl)
    {
        $this->listBl = $bl;

        return $this;
    }

    public function setLigne($ligne)
    {
        $this->ligne = $ligne;

        return $this;
    }

    /**
     * check si si présence resultat dans cache redis
     * @param $categorie
     * @return bool
     */
    public function checkCategorie($categorie)
    {
        return empty($categorie);
    }

    /**
     * ??
     */
    public function searchLigneCategorie()
    {
        var_dump($this->ligne['type_article']);
        die();
    }

    /**
     * Recherche le cache REDIS des categorie .
     * @return mixed
     */
    public function categorieRedisAll()
    {
        $this->categorieRedis = Redis::hgetall($this->categorieName);

        if($this->checkCategorie( $this->categorieRedis ))
        {
            $categoriesDB = $this->categorie->all();

            foreach ($categoriesDB->toArray() as $index => $categorie)
            {
                $jsonCat = json_encode($categorie);
                $title = $categorie['famille'];
                Redis::hset('CategorieController', $title, $jsonCat);
            }

            return $this->categorieRedis =  Redis::hgetall($this->categorieName);
        }

        return $this->categorieRedis;
    }

    /**
     * ??
     * @param $categorie
     */
    public function editCategorie($categorie)
    {

    }

    /**
     *  ??
     * @param $categorie
     */
    public function editCategorieRedis($categorie)
    {

    }


}