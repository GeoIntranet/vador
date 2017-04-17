<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Lib\Gestion;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CalenderController extends Gestion
{
    protected $now;
    /**
     * CalenderController constructor.
     */
    public function __construct(Carbon $now)
    {
            $this->now = $now;
    }


    /**
     * @param $controller
     * @param $dt
     */
    public function selectDt($controller,$dt)
    {
        Session::put($controller, $dt);
        return redirect()->back();
    }

    /**
     * @param $controller
     * @return mixed
     */
    public function getDt($controller)
    {
        $validation = Session::has($controller);

        if($validation <> true)
        {
            Session::put($controller,Carbon::now()->format('Y-m-d'));
        }
        return  Session::get($controller);
    }

    /**
     * @param $controller
     * @param $dt
     * @return mixed
     */
    public function setDt($controller,$dt)
    {
        return Session::put($controller,$dt);
    }

    /**
     * @param $controller
     */
    public function addMonth($controller)
    {
        $dt = $this->getDt($controller) ;

        $dt_ = New Carbon($dt);
        $dt_->addMonth(1);

        Session::put($controller, $dt_);

        return redirect()->back();

    }

    /**
     * @param $controller
     */
    public function addYEar($controller)
    {
        $dt = $this->getDt($controller) ;

        $dt_ = New Carbon($dt);
        $dt_->addYear(1);

        Session::put($controller, $dt_);

        return redirect()->back();
    }

    /**
     * @param $controller
     */
    public function subMonth($controller)
    {
        $dt = $this->getDt($controller) ;

        $dt_ = New Carbon($dt);
        $dt_->subMonth(1);

        Session::put($controller, $dt_);

        return redirect()->back();
    }

    /**
     * @param $controller
     */
    public function subYear($controller)
    {
        $dt = $this->getDt($controller) ;

        $dt_ = New Carbon($dt);
        $dt_->subYear(1);

        Session::put($controller, $dt_);

        return redirect()->back();
    }

    /**
     * @param $controller
     * @param $year
     */
    public function selectYear($controller,$year)
    {
        $dt = $this->getDt($controller) ;
        $validation = $this->validateData($year);

        if($validation)
        {
            $dt = new Carbon($dt);
            $dt->year = $year;
            $this->setDt($controller,$dt->format('Y-m-d'));
            return redirect()->back();

        }

        return redirect()->back();
    }

    public function selectMonth($controller,$month)
    {
        $dt = $this->getDt($controller) ;

        if(isset($this->getCalender()[$month]))
        {
            $dt = new Carbon($dt);
            $dt->month = $month;
            $this->setDt($controller,$dt->format('Y-m-d'));
            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * @param $year
     * @return bool
     */
    public function validateData($year)
    {
        if($this->validateYear($year)) return true;

        return false;
    }

    /**
     * @param $year
     * @param $years_
     * @return bool
     */
    public function validateYear($year)
    {
        $years_ = $this->now->copy()->year;
        return (is_numeric($year)) && (strlen($year) == 4) && ($year >= 2000) && ($year <= $years_);
    }

    /**
     * @param $controller
     * @return \Illuminate\Http\RedirectResponse
     */
    public function returnNow($controller)
    {
        $this->setDt($controller,$this->now->copy()->format('Y-m-d'));
        return redirect()->back();
    }
}
