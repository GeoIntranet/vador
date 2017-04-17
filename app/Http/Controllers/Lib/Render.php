<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/12/2016
 * Time: 11:36
 */

namespace App\Http\Controllers\Lib;


class Render
{

    public $gestion;

    public function __construct($gestion)
    {
        $this->gestion = $gestion;
    }


    public function userExist($id)
    {
        return isset($this->gestion->users[$id]);
    }

    public function getRenderUser($id)
    {
        return $this->gestion->users[$id];
    }
}