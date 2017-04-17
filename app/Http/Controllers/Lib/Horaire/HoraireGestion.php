<?php
namespace App\Http\Controllers\Lib\Horaire;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 11/08/2016
 * Time: 14:41
 */
class HoraireGestion
{

    protected $ferrier;
    protected $now;
    protected $year;

    /**
     * HoraireGestion constructor.
     */
    public function __construct()
    {
        $this->now = Carbon::now();

        $this->year = $this->now->copy()->format('Y');

        $this->ferrier =collect([
            "$this->year-01-01",
            "$this->year-03-28",
            "$this->year-05-01",
            "$this->year-05-05",
            "$this->year-05-08",
            "$this->year-05-16",
            "$this->year-07-14",
            "$this->year-08-15",
            "$this->year-11-01",
            "$this->year-11-11",
            "$this->year-12-25",
        ]);
    }

    public function DayOuvrable($direction='last' , $origin='')
    {
        $origin = $origin === '' ? $this->now : $origin ;

        $isAvailableDate = $origin->copy();

        $available = FALSE ;


        while ($available == FALSE)
        {
            $isAvailableDate = ($direction === 'next') ? $isAvailableDate->addDay(1) :  $isAvailableDate->subDay(1);

            $isWeekend = $isAvailableDate->isWeekend();

            $isFerrier = $this->ferrier->search($isAvailableDate->format('Y-m-d'));

            $available =  ( $isWeekend OR $isFerrier ) ? FALSE : TRUE;

        }
        return  $isAvailableDate ;
    }

    public function nextDayOuvrable($origin='')
    {
        $origin = $origin === '' ? $this->now : $origin ;

        $isAvailableDate = $this->now->copy();

        $available = FALSE ;


        while ($available == FALSE)
        {
            $isAvailableDate->addDay(1)->format('Y-m-d');

            $isWeekend = $isAvailableDate->isWeekend();

            $isFerrier = $this->ferrier->search($isAvailableDate->format('Y-m-d'));

            $available =  ( $isWeekend OR $isFerrier ) ? FALSE : TRUE;
        }
        return  $isAvailableDate ;

    }
}