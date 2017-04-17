<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 25/01/2017
 * Time: 12:54
 */

namespace App\Http\Controllers\Lib\Delais;


use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class FiltreDelaisManager
{
    public $type;
    public $value;
    public $home;
    public $user;
    public $session;


    /**
     * FiltreDelaisManager constructor.
     */
    public function __construct( Session $session , $type , $value )
    {
        $this->type = $type;
        $this->value = $value;
        $this->session = $session;
        $this->user = '';
        $this->categorie = '';
        $this->home = "DelaisController@index";
        Redis::del('cacheDelaisRender');
    }

    public function handle()
    {
        return $this->dispatchJob();
    }

    private function dispatchJob()
    {

        if($this->type == 'date')  $this->FiltreDate();
        if($this->type == 'user') $this->FiltreUser();
        if($this->type == 'categorie') $this->FiltreCategorie();

        return $this;


    }

    private function FiltreDate()
    {
        if($this->value == 'ASC')
        {
            Session::put('delaisControllerDateFilter','ASC');
        }
        elseif($this->value == 'DESC')
        {
            Session::put('delaisControllerDateFilter','DESC');
        }

        return redirect()->action('DelaisController@index')->send();
    }

    private function FiltreUser()
    {

        if( $this->hasDelaisFiltre() )
        {

            $this->user = Session::get('delaisControllerUserFilter');

            $exploded = explode('_',$this->user);

            $isUSer = array_search($this->value,$exploded);

            if( $isUSer !== FALSE )
            {
                unset($exploded[$isUSer]);
            }
            else
            {
                $exploded[] = $this->value;
            }

            if( ! empty($exploded) )
            {
                $imploded = implode('_',$exploded);
                Session::put('delaisControllerUserFilter',$imploded);
                return redirect()->action('DelaisController@index')->send();
            }
            else
            {
                Session::forget('delaisControllerUserFilter');
                return redirect()->action('DelaisController@index')->send();
            }
        }

        Session::put('delaisControllerUserFilter',$this->value);

        return redirect()->action('DelaisController@index')->send();
    }

    private function FiltreCategorie()
    {

        if( $this->hasCategorieFiltre() )
        {
            var_dump($this->hasDelaisFiltre());
            die();

            $this->categorie = Session::get('delaisControllerCategorieFilter');

            $exploded = explode('_',$this->categorie);

            $isCategorie = array_search($this->value,$exploded);

            if( $isCategorie !== FALSE )
            {
                unset($exploded[$isCategorie]);
            }
            else
            {
                $exploded[] = $this->value;
            }

            if( ! empty($exploded) )
            {
                $imploded = implode('_',$exploded);
                Session::put('delaisControllerCategorieFilter',$imploded);
                return redirect()->action('DelaisController@index')->send();
            }
            else
            {
                Session::forget('delaisControllerCategorieFilter');
                return redirect()->action('DelaisController@index')->send();
            }
        }

        Session::put('delaisControllerCategorieFilter',$this->value);
        return redirect()->action('DelaisController@index')->send();
    }

    /**
     * @return mixed
     */
    private function hasDelaisFiltre()
    {
        return Session::has('delaisControllerUserFilter');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectController()
    {
        return redirect()->action('DelaisController@index')->send();
    }

    private function hasCategorieFiltre()
    {
        return Session::has('delaisControllerCategorieFiltre');
    }
}