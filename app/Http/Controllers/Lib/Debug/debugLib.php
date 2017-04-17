<?php
namespace App\Http\controllers\Lib\Debug;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 11/08/2016
 * Time: 14:41
 */
class debugLib implements DebugLibInterface, DebugLibInterface
{


    /**
     * debugLib constructor.
     */
    public function __construct()
    {
    }

    static public function debugj()
    {
        return "mode debug ok ";
    }

}