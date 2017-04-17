<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 22/08/2016
 * Time: 19:49
 */

namespace App\Http\Controllers;


class EuroController extends Controller
{
    protected $input;
    protected $attribute;
    protected $model;


    /**
     * EuroController constructor.
     * @param $attribute
     */
    public function __construct()
    {
        $this->attribute = [];
    }


    /**
     * Nettoie les input en prevision de ne garder que les fillable , et transforme le tout en un tableau
     * @param $model
     * @param $request
     * @return array
     */
    public function fetchModel($model ,$request)
    {
        $this->model = $model;
        $this->input = collect($request->input())->except(['_token','_method']);
        return $this->prepareFillable();

    }

    /**
     * Crée un tableau avec toute les valeur qui seront entrée en BDD;
     * @return array
     */
    public function prepareFillable()
    {
        $fillable = collect($this->model->getFillable());
        $type = collect($this->model->defaultFillable());

        foreach ($fillable as $index => $item) {

            $dataValue = $this->input->get($item);
            $defaultValue = $this->getDefaultValue($type[$item]);

            $this->attribute[$item] = $this->emptyInput($item) ? $dataValue : $defaultValue;

        }

        return $this->attribute;
    }

    /**
     * Retour une valeur par defaut pour un TYPE specifique
     * @param $value
     * @return int|string
     */
    public function getDefaultValue($value)
    {
        switch($value){

            case ('int') :
                return 0 ;
                break;

            case ('var') :
                return '' ;
                break;

        }
    }

    /**
     * Verifie si une input est vide
     * @param $item
     * @return bool
     */
    public function emptyInput($item)
    {
        return $this->input->get($item) !== null;
    }

    public function tutu($bl)
    {
        var_dump($bl);
    }

}