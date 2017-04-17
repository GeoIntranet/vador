<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Search\SearchManager;
use Illuminate\Http\Request;
use App\Http\Requests;

class SearchController extends Controller
{
    private $manager;

    /**
     * SearchController constructor.
     */
    public function __construct(SearchManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        $value = $this->manager->handle();
        if($value->validator->errorDetected == true)
        {
            return view('errors.503');
        }
        else
        {

            if($value->dispatcher->route == 'locatorController@forceSearching')
                return redirect()->action($value->dispatcher->route,[$value->dispatcher->argument['arg'],$value->dispatcher->argument['val']])
                    ;
            return redirect()->action($value->dispatcher->route,[$value->dispatcher->argument]);
        }
    }
}
