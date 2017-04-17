<?php
/**
 * Created by PhpStorm.
 * User: geoffrey
 * Date: 15/08/16
 * Time: 23:39
 */
namespace App\Http\Controllers\Lib\Locator;

interface LocatorRepositoryInterface
{
    /**
     * Creation de l'object LOCATOR
     * @return string
     */
    public function scopeElementLocator( $query);
}