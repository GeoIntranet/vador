<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 19/01/2017
 * Time: 12:44
 */

namespace App\Http\Controllers\Lib\Commande;


use App\Http\Controllers\Lib\Gestion;
use Illuminate\Support\Facades\Redis;

class WorkwithTag
{

    public $lignes;
    public $uniqueType;
    public $mapCmdToType;
    public $mapTypeToCmd;
    public $tags;
    public $gestion;
    /**
     * WorkwithTag constructor.
     */
    public function __construct($lignes)
    {
        $this->lignes = $lignes;
        $this->gestion = new Gestion();
    }

    public function handle()
    {
        $this->uniqueType = $this->getUniqueType();
        $this->cleanType();

       $categories = Redis::hgetall('CategorieController');
       $tags = [];

        foreach ($categories as $index => $cat)
        {
            $decodeCategorie = json_decode($cat);

            $decodeCategorie = collect($decodeCategorie)->flip()->flip()->forget('mo');

            $famille = $decodeCategorie['famille'];


            if(isset($this->uniqueType[$famille]))
            {
                foreach (collect($this->gestion->getCategorieDB()) as $index => $tag)
                {
                    if(isset($decodeCategorie[$tag]) AND $decodeCategorie[$tag] === 1)
                    {
                        $tag_ = new \stdClass();

                        $tag_->tag = $tag;
                        $tag_->color = 'tag_color_'.$tag;
                        $tag_->abbr = strtoupper( substr($tag,0,2));
                        $tag_->fullName = $this->gestion->getCategorieGlobal()[$tag];

                        $this->tags[$famille] = $tag_;

                    }
                }
            }
        }

        $this->mapCmdToType = $this->mapCmdToType();
        $this->clean();

        return $this;
    }

    /**
     * @return mixed
     */
    private function getUniqueType()
    {
        $uniqueType = $this->lignes->pluck('type_article', 'type_article');
        return $uniqueType;
    }

    /**
     * @param $type
     * @return mixed
     */
    private function mapCmdToType()
    {
        $type = [];
        $this->mapTypeToCmd = [];

        foreach ($this->lignes as $index => $ligne)
        {


            $bl = $ligne['id_cmd'];
            $typeArticle = $ligne['type_article'];

            if(isset($this->tags[$typeArticle]))
            {
                $tag = $this->tags[$typeArticle]->tag;
                $type[$ligne['id_cmd']][$tag] = $this->tags[$typeArticle];
                $this->mapTypeToCmd[$tag][$ligne['id_cmd']] = '';
            }

        }

        return $type;
    }

    private function clean()
    {
        unset($this->lignes);
        unset($this->gestion);
        unset($this->uniqueType);
        unset($this->tags);
    }

    private function cleanType()
    {
        $ForgetKeys = collect([
            'MODT',
            'DIVERS',
            'PRODE/C'
        ])
            ->flip();

        foreach ($this->uniqueType as $index => $type) {
            if($ForgetKeys->has($index))
            {
                unset($this->uniqueType[$index]);
            }
        }
    }

}