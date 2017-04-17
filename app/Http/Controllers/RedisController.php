<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Cache\RedisStore;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{

    public function Categorie()
    {
        $categories = Categorie::all();

        foreach ($categories->toArray() as $index => $category)
        {
            $jsonCat = json_encode($category);
            $title = $category['famille'];

            Redis::hset('CategorieController',$title,$jsonCat);
        }

        //return redirect()->back();

    }

    public function deleteCategorie()
    {
        Redis::del('CategorieController');
        return redirect()->back();
    }

    public function test()
    {
        $redis = app(RedisStore::class);
        var_dump($redis->setPrefix('test'));
        $redis->put('data:test',4354354,60);
    }
}
