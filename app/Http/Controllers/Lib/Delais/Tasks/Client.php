<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 16:30
 */

namespace App\Http\controllers\Lib\Delais\Tasks;


class Client
{

    protected  $listClient;
    protected  $Client;
    public $data;
    /**
     * FormatClient constructor.
     */
    public function __construct($listClient , $client)
    {
        $this->Client = $client;
        $this->listClient = $listClient->client;
        $this->data = [];

        $this->execute();

    }

    public function execute()
    {


        $this->data = [
            'id' => $this->Client->id_client,
            'nsoc' => $this->listClient[$this->Client->id_client],
        ];

        return $this->data;
    }
}