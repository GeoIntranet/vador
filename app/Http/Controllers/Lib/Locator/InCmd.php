<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 07/04/2017
 * Time: 14:36
 */

namespace App\Http\Controllers\Lib\Locator;


use App\Stock;
use Carbon\Carbon;

class InCmd
{
    public function selectIn($arg = null)
    {
        $dt = Carbon::now();
        $dt->subMonths(3);

        $ids = Stock::where('in_datetime','>',$dt->toDateTimeString())
            ->with('articleModel')
            ->orderBy('in_datetime','DESC')
        ;

        if($arg == 'paginate') $ids = $ids->paginate(20);
        if($arg == null) $ids = $ids->get();

        return $ids;
    }
}