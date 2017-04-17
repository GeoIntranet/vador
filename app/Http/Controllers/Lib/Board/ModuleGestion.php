<?php
namespace App\Http\Controllers\Lib\Board;
use App\Http\Controllers\Lib\Board\Module\ArriveModule;
use App\Http\Controllers\Lib\Board\Module\ContentModule;
use App\Http\Controllers\Lib\Board\Module\IncidentModule;

/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 01/02/2017
 * Time: 13:08
 */
class ModuleGestion
{
    public $user;
    public $map;
    public $data;
    public $result;

    /**
     * ModuleGestion constructor.
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->modules = $this->user->modulesToSearch;
        $this->template = $this->user->template;
        $this->map = $this->user->map;

        $this->availableModule= [
            'mIncident',
            'mArrive'
        ];

    }

    public function handle()
    {
        foreach ($this->modules as $index => $module) 
        {
            $name = $this->getModuleName($module);
            $objet = $module == 'mContent' ? new ContentModule($this->user) : app( $name );
            $this->data[$module] = $objet->handle();
        }

        $this
            ->toFit()
        ;

        return $this->result;
    }

    public function getModuleName($name)
    {
        return 'App\Http\Controllers\Lib\Board\Module\\'.substr($name,1).'Module';
    }

    private function toFit()
    {
        foreach ($this->map as $index => $map)
        {
            $data = isset($this->data[$map]) ? $this->data[$map] : '';
            $this->result[$map] = $data;
        }

        return $this;
    }

    private function clean()
    {
        unset($this->modules);
        unset($this->map);
        unset($this->data);
    }


}