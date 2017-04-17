<?php
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 07/02/2017
 * Time: 22:01
 */

namespace App\Console\Commands\Board;


use App\Http\Controllers\Lib\Board\Module\InfoModule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class InfoCache extends Command
{
    public $info;
    public $keys;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'board:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cache info';

    /**
     * ArriveCache constructor.
     */
    public function __construct(InfoModule $info)
    {
        parent::__construct();

        $this->info = $info;

        $this->keys= [
            'birthday.users',
            'locator.audit.counter',
            'incident.all.actif',
            'absence',
            'commande.encour',
        ];
    }

    public function handle()
    {
        $this->deleteGenericKeys();

        $this->info->auditLogic();
        $this->info->incidentLogic();
        $this->info->absenceLogic();
        $this->info->commandeLogic();
    }

    public function deleteGenericKeys()
    {
        foreach ($this->keys as $key)
        {
            $inc = Redis::get($key);
            if ($inc <> null ) Redis::del($key);
        }
    }
}