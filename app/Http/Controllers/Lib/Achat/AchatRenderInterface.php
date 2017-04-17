<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/12/2016
 * Time: 10:53
 */

namespace App\Http\Controllers\Lib\Achat;


interface AchatRenderInterface
{
    function __construct($achat,$action,$po,$gestion);

    function render();
    function getDescription();
    function getUser();
    function getArrive();
    function getPo();

}