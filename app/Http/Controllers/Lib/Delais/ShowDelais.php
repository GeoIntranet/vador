<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 04/12/2016
 * Time: 15:48
 */

namespace App\Http\Controllers\Lib\Delais;

use App\Http\Controllers\Lib\Delais\Tasks\Client;
use App\Http\Controllers\Lib\Delais\Tasks\DateCommande;
use App\Http\Controllers\Lib\Delais\Tasks\DateEnvoie;
use App\Http\Controllers\Lib\Delais\Tasks\DemandeAchat;
use App\Http\Controllers\Lib\Delais\Tasks\Incident;
use App\Http\Controllers\Lib\Delais\Tasks\Preparateur;
use App\Http\Controllers\Lib\Delais\Tasks\Tag;
use App\Http\Controllers\Lib\Delais\Tasks\Vendeur;

class ShowDelais
{

    protected $orderGestion;
    protected $orderValue;
    protected $orderDelaisValue;
    protected $tasks;

    /**
     * Delais constructor.
     * @param $value
     */
    public function __construct($orderGestion,$orderDelaisValue = null , $orderValue)
    {
        $this->orderGestion = $orderGestion;
        $this->orderDelaisValue = $orderDelaisValue;
        $this->orderValue = $orderValue;

        $this->tasks=[
            Client::class,
            Vendeur::class,
            Tag::class,
            Preparateur::class,
            DateEnvoie::class,
        ];
    }

    /**
     * @return $this
     */
    public function render()
    {
        $this->fixeTasks();

        foreach ( $this->tasks as $task )
        {
            $object = new $task($this->orderGestion, $this->orderDelaisValue);

            $namedClass = $this->getNameClass($object);

            $this->$namedClass=$object->data;
        }

        $this->clearVariable();

        return $this;
    }

    private function fixeTasks()
    {

        $this->bl = $this->orderValue->id_cmd;
        $this->codeClient = $this->orderValue->cd_cmd_cli;
        $this->info_prod = $this->orderValue->info_prod;
        $this->devis = $this->orderDelaisValue->devis;
        $this->close = $this->orderDelaisValue->close;
        $this->dateCommande = $this->orderDelaisValue->date_cmd;
        $this->dtExp = $this->orderDelaisValue->date_envoie;
    }

    /**
     * @param $object
     * @return string
     */
    public function getNameClass($object)
    {
        return substr(get_class($object), strrpos(get_class($object), '\\') + 1);
    }

    /**
     * enleve les variables superflues
     */
    private function clearVariable()
    {
        unset ($this->tasks );
        unset ($this->orderGestion );
        unset ($this->orderValue );
        unset ($this->orderDelaisValue );
    }
}