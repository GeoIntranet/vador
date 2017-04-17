<?php
namespace App\Http\Controllers\Lib\Filter;
use Illuminate\Http\Request;


/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 13/04/2017
 * Time: 14:49
 */
abstract class Filter
{
    protected $builder;
    protected $request;
    protected $filters= [];

    /**
     * Filter constructor.
     * @param $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply($builder)
    {
        $this->builder = $builder;

        if ($filtres = $this->getFilter()) {

            foreach ($filtres as $filtre => $value) {
                if (method_exists($this, $filtre)) {
                    $this->$filtre($value);
                }
            }
        }
        return $this->builder;
    }

    /**
     * @return array
     */
    private function getFilter()
    {
        return $this->request->intersect($this->filters);
    }


}