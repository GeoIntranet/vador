<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/02/2017
 * Time: 22:20
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\Http\Controllers\Lib\Gestion;
use Carbon\Carbon;

class ContentModule extends Module
{
    public $template;
    public $toSearch;
    public $now;
    public $user;
    public $data;

    /**
     * ContentModule constructor.
     */
    public function __construct( $user)
    {
        parent::__construct();

        $this->user = $user;
        $this->template = $this->user->template;
        $this->moduleName = [
            'TEMPLATE_rapidsearch',
            'TEMPLATE_google',
            'TEMPLATE_news',
            'TEMPLATE_fav',
        ];
        $this->toSearch=collect([]);
        $this->data = collect([]);
        $this->now = Carbon::now();

    }

    public function handle()
    {
        $this
            ->flatObject()
            ->moduleToSearch()
            ->organiseUser()
            ->organiseDate()
            ->searchModule()
        ;

        return $this->data->toArray();
    }


    /**
     * transforme l'entrée en un tableau
     * @return $this
     */
    private function flatObject()
    {
        $this->template = is_a($this->template,'App\TemplateRight') ? collect($this->template)->toArray() : $this->template ;

        return $this;
    }

    /**
     * Recherche les sous module a inclure dans content
     */
    private function moduleToSearch()
    {
        foreach ($this->moduleName as $index => $item)
        {
            if($this->template[$item] == 1 ) $this->toSearch->push(ucfirst(substr($item,9)));
        }
        $this->data['toSearch'] = $this->toSearch->toArray();

        return $this;
    }

    private function organiseUser()
    {
        $this->data['user']=
        [
            'nom' => $this->user->info->USER_nom,
            'prenom' => $this->user->info->USER_prenom,
            'admin' => $this->isAdmin(),
            'id' => $this->user->info->USER_id,
        ];

        return $this;
    }

    private function organiseDate()
    {
        $gestion = new Gestion();

        $this->data['date']=$gestion->dateLisible($this->now,'normalWithNotYear');

        return $this;
    }

    private function isAdmin()
    {
        return $this->user->info->USER_type > 6 ? TRUE : FALSE;
    }

    private function searchModule()
    {
        foreach ($this->toSearch as $index => $module)
        {
            $class = 'App\Http\Controllers\Lib\Board\Module\\'.$module.'Module';

            $class =  app( $class )->handle() ;

            $this->data[$module] =  $class;
        }
    }


}