<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 28/12/2016
 * Time: 17:28
 */

namespace App\Http\Controllers\Lib;


class WorkWith
{
    public $in;
    public $mode;
    public $type;
    public $out;

    public $error;

    CONST CONCAT_TYPE = 'concat';
    CONST ARRAY_TYPE = 'array';
    CONST UNIQUE_TYPE = 'unique';
    CONST VAR_TYPE = 'var';

    CONST BL_MODE = 'bl';
    CONST DA_MODE = 'da';
    const CLIENT_MODE = 'client';

    CONST ERROR = 'error';

    CONST RENDER_ACHAT_DELAIS = 'App\Http\controllers\Lib\Achat\AchatRenderDelais';
    CONST RENDER_COMMANDE_DELAIS = 'App\Http\controllers\Lib\Commande\CommandeRenderDelais';
    CONST RENDER_COMMANDE_LiGNE_DELAIS = 'App\Http\controllers\Lib\Commande\LigneRenderDelais';
    CONST RENDER_GENERAL = 'App\Http\controllers\Lib\Achat\AchatRenderDelais';

    /**
     * @param $in
     * @return $this
     */
    public function setIn($in)
    {

        $this->in = $in;

        return $this;
    }

    /**
     * autodetection du mode et type d'entrée
     * array / concat / unique
     * mode da / bl ...
     * @return $this
     */
    public function autoDetect()
    {

        if($this->in <> null)
        {
            if($this->type == null ) $this->type = $this->findType();
            if($this->mode == null ) $this->mode = $this->findMode();

            return $this;
        }

        $this->error = "aucune donnee";

        return $this->error;
    }

    /**
     * recherche type d'entrée Array / concaténation / entrée unique
     * @return string
     */
    private function findType()
    {

        if( ! $this->isArrayType() )
        {
            $concat = strstr($this->in,'_');

            if( ! $concat)
            {
                if(is_numeric($this->in))return self::UNIQUE_TYPE;

                return 'error';
            }

            return self::CONCAT_TYPE;
        }

        return self::ARRAY_TYPE;
    }

    /**
     * recherche le mode de donné BL ou DA
     * @return $this
     */
    private function findMode()
    {
        if($this->isTypeArray())
        {
            return strlen($this->in[0]) === 7 ? self::BL_MODE : self::DA_MODE ;
        }
        elseif ($this->isTypeConcat())
        {
            $str = explode('_',$this->in);
            return strlen($str[0]) === 7 ? self::BL_MODE : self::DA_MODE ;
        }
        else
        {
            return strlen($this->in) === 7 ? self::BL_MODE : self::DA_MODE ;
        }

    }

    /**
     * transform array or concatform (xx_xx_xx ) into COLLECTION - collect(array[..])
     * @return $this
     */
    public function transform()
    {

        if($this->isTypeArray() or $this->isTypeUnique())
        {
            $this->out = collect($this->in);
        }
        elseif ($this->isTypeConcat())
        {
            $str = explode('_',$this->in);
            $this->out = collect($str);
        }

        return $this;
    }
    /**
     * test si l'entrée donné un de type tableau ou collection.
     * @return bool
     */
    private function isArrayType()
    {
        $array =false;

        if (is_array($this->in) or is_a($this->in, 'Illuminate\Support\Collection'))
            $array = true;

        return $array;
    }
    /**
     * @return bool
     */
    private function hasType()
    {
        return $this->type <> null ? TRUE : FALSE;
    }

    /**
     * @return bool
     */
    private function hasMode()
    {
        return $this->mode <> null ? TRUE : FALSE;
    }

    /**
     * @return bool
     */
    public function isTypeArray()
    {
        return $this->type === self::ARRAY_TYPE;
    }

    /**
     * @return bool
     */
    public function isTypeConcat()
    {
        return $this->type === self::CONCAT_TYPE;
    }

    /**
     * @return bool
     */
    public function isTypeUnique()
    {
        return $this->type === self::UNIQUE_TYPE;
    }

    /**
     * @param $gestion
     */
    public function setGestion($gestion)
    {
        $this->gestion = $gestion;
    }


}