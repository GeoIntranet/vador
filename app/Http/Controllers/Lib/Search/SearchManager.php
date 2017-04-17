<?php
namespace App\Http\Controllers\Lib\Search;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 25/02/2017
 * Time: 15:02
 */
class SearchManager
{
    public $validator;


    /**
     * SearchManager constructor.
     */
    public function __construct(Validator $validator, Dispatcher $dispatcher )
    {
        $this->validator = $validator;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Point d'entrée du manager de recherche
     * il vas effectuer les differentes taches.
     * @param $request
     */
    public function handle()
    {
        $inputInformation = $this->validator->validateRequestInput();

        if( $inputInformation->errorDetected == FALSE)
        {
            $router = $this->dispatcher->getRoute($inputInformation);
        }

        return $this;
    }

}