<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 30/01/2017
 * Time: 22:30
 */

namespace App\Http\Controllers\Lib\User;


use App\TemplateRight;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TemplateRepository extends UserGestion
{
    public $template;
    public $default;
    public $map;
    public $modulesToSearch;



    /**
     * TemplateRepository constructor.
     */
    public function __construct()
    {
        $this->default = FALSE;

        parent::__construct();

        $this->moduleContentName=
        [
            'cRapidsearch',
            'cNews',
            'cFav',
            'cGoogle',
        ];

        $this->default=[
            'id' =>  'default',
            'TEMPLATE_id' =>  1,
            'TEMPLATE_user_id' =>  48,
            'TEMPLATE_M1' =>  'mIncident' ,
            'TEMPLATE_M1_mode' =>  1,
            'TEMPLATE_M2' =>  'mContent' ,
            'TEMPLATE_M2_mode' =>  1,
            'TEMPLATE_M3' =>  'mArrive' ,
            'TEMPLATE_M3_mode' =>  1,
            'TEMPLATE_M4' =>  'mIncident',
            'TEMPLATE_M4_mode' =>  1,
            'TEMPLATE_M5' =>  'mIncident',
            'TEMPLATE_M5_mode' =>  1,
            'TEMPLATE_M6' =>  'mIncident',
            'TEMPLATE_M6_mode' =>  1,
            'TEMPLATE_M7' =>  'mIncident',
            'TEMPLATE_M7_mode' =>  1,
            'TEMPLATE_M8' =>  'none' ,
            'TEMPLATE_M8_mode' =>  1,
            'TEMPLATE_M9' =>  'none' ,
            'TEMPLATE_M9_mode' =>  1,
            'TEMPLATE_M10' =>  'none' ,
            'TEMPLATE_M10_mode' =>  1,
            'TEMPLATE_M11' =>  'none' ,
            'TEMPLATE_M11_mode' =>  1,
            'TEMPLATE_rapidsearch' =>  1,
            'TEMPLATE_google' =>  0,
            'TEMPLATE_news' =>  0,
            'TEMPLATE_news_mod' =>  0,
            'TEMPLATE_fav' =>  1,
            'TEMPLATE_fav_mod' =>  1,
        ];

    }


    public function handle()
    {
        $this
            ->getTemplate()
            ->mapKeyToModule()
            ->getTemplateNumber()
            ->extractModule();

        $this->clean();

        return $this;
    }
    
    public function getTemplate()
    {
        try
        {
            $this->template = TemplateRight::UserRight($this->id)->firstOrFail();
        }
        catch (ModelNotFoundException $e)
        {
            $this->template = $this->default;
            $this->default = TRUE;
        }

        return $this;
    }

    /**
     * retourne le numero du template
     */
    public function getTemplateNumber()
    {
        $this->templateNumber = is_object($this->template) ? $this->template->TEMPLATE_id : $this->template['TEMPLATE_id'];
        return $this;
    }

    /**
     * crée un tableau avec le n°1 du module et son NOM correspondant
     * @return $this
     */
    public function mapKeyToModule()
    {
        for( $i=1; $i < 12 ;$i++ )
        {
             $this->map['M'.$i]=$this->template['TEMPLATE_M'.$i];

        }
        $this->map = collect($this->map);

        return $this;
    }

    public function extractModule()
    {
        $tmp =
            $this->map
            ->flip()
            ->forget('none')
        ;

        $this->modulesToSearch = array_keys($tmp->toArray());

        return $this;
    }

    private function clean()
    {
        unset($this->default);
        unset($this->moduleContentName);

    }


}