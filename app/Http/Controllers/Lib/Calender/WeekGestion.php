<?php
/**
 * Created by PhpStorm.
 * User: Valer
 * Date: 12/01/2018
 * Time: 21:45
 */

namespace App\Http\Controllers\Lib\Calender;

use Carbon\Carbon;

class WeekGestion
{
    public $dateReference;
    public $lastDay;
    public $firstDay;
    public $week;

    /**
     * WeekGestion constructor.
     */
    public function __construct()
    {
        $this->dateReference = Carbon::now();
        $this->ouvrable = [1,2,3,4,5];
        $this->days = [
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
        ];

    }

    public function setStarterDate($date)
    {
        $this->dateReference = new Carbon($date);

        return $this;
    }

    public function generateWeek()
    {
        $this->firstDay =  $this->dateReference->copy()->startOfWeek();
        $this->lastDay =  $this->dateReference->copy()->endOfWeek()->subDays(2);

        $this->week = [] ;
        $copyReferenceDate = $this->firstDay->copy();
        $index=1;

        for($i = $copyReferenceDate ; $i < $this->lastDay ; $i->addDay(1))
        {
            $this->week[$index++] = $i->copy() ;
        }

        return $this;
    }

    public function firstDay()
    {
        return $this->firstDay->format('Y-m-d');
    }

    public function lastDay()
    {
        return $this->lastDay->format('Y-m-d');
    }

    /**
     * retourne la semaine sous forme de tableau
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }
}