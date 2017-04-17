<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:29
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class DateCommande
{
    public $data;
    /**
     * FormatClient constructor.
     */
    public function __construct()
    {
        $this->data = '';
        $this->execute();
    }

    public function execute()
    {
        $this->data = 'Panavi';
        return $this->data;
    }
}