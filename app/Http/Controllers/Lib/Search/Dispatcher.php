<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 26/02/2017
 * Time: 15:58
 */

namespace App\Http\Controllers\Lib\Search;


class Dispatcher
{
    public $route;
    public $argument;
    public $router;


    /**
     * Dispatcher constructor.
     * @param $route
     */
    public function __construct()
    {
        $this->route = false;
        $this->argument = false;
        $this->router = collect(
            [
                'incident' => 'IncidentController@show',
                'achat' => 'IncidentController@show',
                'id' => 'locatorController@forceSearching',
                'article' => 'IncidentController@show',
                'client' => 'IncidentController@show',
                'commande' => 'IncidentController@show',
            ]
        );
    }


    public function getRoute($inputInformation)
    {
        $this->input = $inputInformation;

        $this->route = $this->router->get($this->input->result);

        $this->argument = $this->input->usefullDataArgument;

        return $this;
    }
}