<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 25/02/2017
 * Time: 15:41
 */

namespace App\Http\Controllers\Lib\Search;



class ConstantSearch
{

    public $key =
        [
            'id' => TRUE,
            'da' => TRUE,
            'po' => TRUE,
            'bl' => TRUE,
            'cl' => TRUE,
            'lo' => TRUE,
            'ar' => TRUE,
        ];

    public $validArgument =
        [
            'identifyId',
            'identifyPo',
            'identifyDa',
            'identifyLocator',
            'identifyClient',
            'identifyCommand',
            'identifyArticle',
        ];

    public $magic =
        [
            '$'=> FALSE,
            '*'=> FALSE,
            ' '=> FALSE
        ];

    public  $validShortCut =
        [
            'identifyShortCutCatalogue',
            'identifyShortCutLocator',
            'identifyShortCutIncident',
            'identifyShortCutAchat',
            'identifyShortCutCommande',
        ];

    public $fromInterupt =
        [
            'IncidentController',
            'AchatController',
        ];

    public $shortCut =
        [
            'cat',
            'loc',
            'inc',
            'da',
            'bl',
        ];

    public $input;
    public $from;
    public $isMagic;
    public $howLenght;
    public $isNumeric;
    public $isKeyInput;
    public $usefullDataArgument;
    public $usefullDataSymbol;
    public $errorDetected;
    public $isNumericFormat;

    /**
     * ConstantSearch constructor.
     */
    public function __construct( $input )
    {
        $this->isValidate = FALSE;
        $this->input = $input['search'];
        $this->from =  json_decode( $input['from']);
    }


    public function bootConstant()
    {
        $this->isMagic = $this->isMagic();
        $this->isKeyInput = $this->isKeyInput();

        $this->extractUsefullData();

        $this->howLenght = $this->howLenght();
        $this->isNumeric = $this->isNumeric();

        $this->isNumericFormat = $this->isNumericFormat();

        $this->extractFromInformation();

        return $this;
    }

    /**
     * Sert a savoir si le premier charactère taper est un caractère magique
     * @param $input
     * @return bool
     */
    private function isMagic()
    {
        $char = substr($this->input,0,1);

        return collect($this->magic)->has($char) ;
    }

    /**
     * retourne le nombre de caractère de la recherche
     * @param $input
     * @return int
     */
    private function howLenght()
    {
        return strlen($this->input);
    }

    private function isNumeric()
    {
        return is_numeric($this->input);
    }

    public function cleanConstant()
    {
        unset($this->key);
        unset($this->magic);
        unset($this->validArgument);
        unset($this->validShortCut);
        unset($this->shortCut);
    }

    private function extractUsefullData()
    {
        $starter = 0;
        $starter = $this->isMagic ? 1 : $starter;
        $starter = $this->isKeyInput ? 2 : $starter;
        $starterCli = $starter + 1;

        $this->usefullDataSymbol = substr($this->input,0,$starter);


        if($this->usefullDataSymbol == 'cl')
        {
            $isNum = substr($this->input+1,1);

            if( ! is_numeric($isNum) ) return $this->usefullDataArgument = substr($this->input,$starterCli) ;

            return $this->usefullDataArgument = substr($this->input,$starter);
        }

        if($this->usefullDataSymbol == 'id') return $this->usefullDataArgument = ['arg' => 'id' , 'val' => substr($this->input,$starter)];

        return $this->usefullDataArgument = substr($this->input,$starter);
    }

    private function isKeyInput()
    {
        return collect($this->key)->has( substr($this->input,0,2) ) ? TRUE : FALSE;
    }

    private function extractFromInformation()
    {

    }

    private function haveError()
    {
        $state = $this->result ;
    }

    private function isNumericFormat()
    {
        if($this->isNumeric == TRUE )
        {
            return $this->howLenght >=5 AND $this->howLenght <=7 ? TRUE : FALSE;
        }
        return FALSE;
    }
}