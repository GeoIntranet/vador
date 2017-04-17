<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 02/02/2017
 * Time: 21:49
 */

namespace App\Http\Controllers\Lib\Board\Module;


use App\CrmAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class CrmModule extends Module
{

    public $action;
    public $module;
    public $maintenance;


    /**
     * CrmModule constructor.
     */
    public function __construct(CrmAction $action)
    {
        $this->action = $action;
        $this->module = FALSE;

        parent::__construct();
    }

    public function handle()
    {
        $this->logic();


        return $this->module;

    }

    private function logic()
    {
        $lastAct = $this->last();

        if (!is_null($lastAct) OR empty($lastAct) OR $lastAct == '' OR $lastAct == FALSE OR $this->maintenance == TRUE) {
            foreach ($lastAct as $k => $v) {
                $this->module[] =
                    [
                        'client' => substr($v->nsoc, 0, 15),
                        'TA' => $v->type_action,
                        'info' => substr(strip_tags($v->info), 0, 80),
                        'infoT' => substr(strip_tags($v->info), 0, 800),
                        'dt' => new Carbon($v->creat),
                    ];
            }
        }
    }

    /**
     * @return mixed
     */
    public function last()
    {
        $key = 'board.crm.action.last';
        $cache = Redis::get($key);

        if( ! $cache)
        {
            $data = $this->action->Last(10);
            Redis::set($key,serialize($data));
        }
        else
        {
            $data = unserialize($cache);
        }

        return $data;
    }
}