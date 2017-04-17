<?php
namespace App\Http\Controllers\Lib\Locator;

use App\Container;


class LocatorGenerator extends LocatorConfiguration implements LocatorGeneratorInterface
{

    public $locatorModel;
    public $dataModel;
    public $object;

    public $subValues;
    public $subKeys;
    public $subKeysRows;
    public $subValuesRows;


    
    /**
     * LocatorGenerator constructor.
     */
    public function __construct( Container $locatorModel)
    {
        $this->locatorModel = $locatorModel;
        $this->object = [];
    }
    
    /**
     * Info si Base de donné vide
     * @return bool
     */
    public function isInit()
    {
        return $this->locatorModel === NULL ? FALSE : TRUE ;
    }

    /**
     * Info si utilisateur a les droit pour crée / modifier / supprimer un emplacement Locator
     * @return bool
     */
    public function isInitiable()
    {
        return $this->isAdmin() == TRUE ? TRUE : FALSE ;
    }

    /**
     * Creation de l'object LOCATOR
     * @return string
     */
    public function make()
    {
        /**
         * 1 . recupe des données - ETAPE OU ON PEUT INTEGRER FILTRE ET PARAM - 
         * 2 . on les tri / fragmente en sous ensemble
         * 3 . Init header / body / footer - initCore
         */
        $this->getZoneNumber();
        $this->containerFragmenter();
        $this->initCore();
        return $this->object;

    }

    /**
     * Initialise l'object Locator final
     */
    public function initCore()
    {
        $this->makeHeader();
        $this->prepareBody();
        $this->makeFooter();

        return $this;
    }

    /**
     * initialisation pour les variable necessaire a la creation de l'object
     */
    public function initVariable()
    {
        $this->setSubNumber($this->locatorModel->subNumber());
    }

    /**
     * ouverture du tableau
     */
    public function makeHeader()
    {
        $this->object['header'] = "<table class='table'>" ;
    }

    /**
     * fermeture du tableau
     */
    public function makeFooter()
    {
        $this->object['footer'] = "</table> " ;
    }

    /**
     * creation du table Body , groupé par SUB
     */
    public function prepareBody()
    {
        foreach ($this->object['subValues'] as $keySubValues => $subValues)
        {
            $this->prepareSubBody($keySubValues,$subValues);
        }
    }

    /**
     * creation du Sub > body
     * @param
     */
    public function prepareSubBody($keySubValues,$subValues)
    {
        $this->object['tbody'][$keySubValues]="<tbody></tbody>";
    }

    /**
     * Retourne les valeurs des differents sous container  $sub
     */
    public function getZoneNumber()
    {
        $this->subKeys = collect($this->locatorModel->SubKey())->flip();
        $this->object['subKeys'] = $this->subKeys;
    }


    /**
     * Fragmente les données recuperer
     */
    public function containerFragmenter()
    {
        foreach ($this->subKeys as $index => $subKey_) {
            $this->calculateSubValue($index);
        }
    }

    /**
     * Nous retourne les valeurs d'un sous ensemble $sub
     * @param $sub
     */
    public function calculateSubValue($sub)
    {
        $this->subValues = collect($this->locatorModel->SubValue($sub));
        $this->subValues = $this->subValues->groupBy('row')->toArray();
        $this->object['subValues'][$sub] = $this->subValues;
    }
}