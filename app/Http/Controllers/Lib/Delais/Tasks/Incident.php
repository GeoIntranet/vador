<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:31
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class Incident
{

    public $data;
    private $delaisItem;
    private $orderGestion;

    /**
     * FormatClient constructor.
     */
    public function __construct($orderGestion,$delaisItem)
    {
        $this->data = '';
        $this->delaisItem = $delaisItem;
        $this->orderGestion = $orderGestion;

        $this->execute();
    }

    public function execute()
    {
        var_dump($this->delaisItem->liste_inc);
        $this->data = 'no incident';
        return $this->data;
    }
}