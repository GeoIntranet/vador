<?php
namespace App\Http\Controllers\Lib\Filter;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 13/04/2017
 * Time: 14:49
 */
class ThreadFilter extends  Filter
{

    /**
     * @var array
     */
    protected $filters = ['by'];


    /**
     * @param $name
     * @return mixed
     */
    public function by($name)
    {
        return $this->builder->where('user_id',$name);
    }

}