<?php
namespace App\Http\controllers\Lib\Delais\Tasks;

class Tag
{

    public $data;

    /**
     * object orderGestion qui contient l'objet gestion
     * on vas recuperer dans l'object DelaisItem les different tags
     * DelaiItem = resultat unique base de donné correspondant a un delais specific via id_cmd
     * grace a la function getTag dans l'object gestion
     *
     * @return string
     */
    public function execute()
    {
        $this->data = $this->orderGestion->gestion->getTag($this->delaisItem);
        return $this->data;
    }

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
}