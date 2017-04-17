<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 22/03/2017
 * Time: 13:25
 */

namespace App\Http\Controllers\Lib\Locator;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LocatorCache
{
    public $user;
    public $keys;


    /**
     * LocatorCache constructor.
     */
    public function __construct()
    {

        $this->user = Auth::user()->id;

        $this->keys=[
            'filterQuery' => 'locator_query_filtred_'.$this->user,
        ];
    }

    /**
     * Mise en forme du input , pour avoir un rendu lisible de la recherche
     * En registrement du input brut dans un HASHES redis
     * avec comme index un timestamp unix et en valeur un tableau read + inpt
     * read = nom lisible
     * input = input brut
     * @param $input
     * @return string
     */
    public function cacheQueryFiltred($input)
    {
        $data =json_encode(
        [
            'read' => $this->formateFilterQuery($input),
            'input' => $input
        ]);

        $redisValueDataStored = collect(Redis::HGETALL($this->keys['filterQuery']))->flip();

        if( ! $redisValueDataStored->has($data) ) Redis::HSET($this->keys['filterQuery'],time(),$data) ;
        else{
            Redis::HDEL($this->keys['filterQuery'],$redisValueDataStored[$data]);
            Redis::HSET($this->keys['filterQuery'],time(),$data) ;
        }

        return $data ;
    }

    /**
     * format le nom lisible de la recherche
     * qui vas etre enregistrer dans le cache redis
     * @param $input
     * @return mixed|string
     */
    private function formateFilterQuery($input)
    {
        $readableContent = '';

        if ($input['id'] <> '') $readableContent = $readableContent . ' ' . $input['id'];
        if ($input['emplacement'] <> '') $readableContent = $readableContent . ' ' . substr($input['emplacement'],0,4);
        if ($input['article'] <> '') $readableContent = $readableContent . ' ' . $input['article'];
        if ($input['description'] <> '') $readableContent = $readableContent . ' ' . $input['description'];

        $readableContent = strtoupper(deleteSpaceStartAndEnd($readableContent));
        $readableContent = str_replace(' ', ' - ', $readableContent);
        $data = [
            'read' => $readableContent,
            'input' => $input,
        ];

        return $data['read'];
    }

    /**
     * nous indique si le cache dont la cle est specifier exist
     * - Attention ( marque que pour les HASHES ) -
     * @param $key
     * @param bool $option
     * @return mixed
     */
    public function exist($key,$option=true)
    {
        $key = $option == TRUE  ? $key.$this->user : $key;
        return Redis::HLEN($key);
    }

    /**
     * nous retourne le contenu de la clef donné
     * et nous formate la donnée.
     * @param $key
     * @param bool $option
     * @return array
     */
    public function get($key,$option=true)
    {
        $key = $option == TRUE  ? $key.$this->user : $key;

        $data = Redis::HGETALL($key);

        $result = [];

        foreach ($data as $index => $value)
        {
            $decode = json_decode($value);
            $result[$index] =
                [
                    'input' => $decode->input,
                    'read' => $decode->read
                ];
        }
        krsort($result);

        return $result;
    }

}