<?php
namespace App\Http\Controllers\Lib\Object;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 27/12/2016
 * Time: 22:23
 */
class Commande
{
    public $attr;
    public $date;

    /**
     * Commande constructor.
     * @param $attr
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->date = $item['date_cmd'];

    }


    public function formateDate()
    {
        $dt = new Carbon($this->date);
        return $dt->format('Y-m-d');
    }



    public function __get($item)
    {
        if (isset($this->item[$item])) {
            return $this->item[$item];
        } else {
            $msg = "Invalid property: '$item' does not exist";
            throw new OutOfBoundsException($msg);
        }
    }

}